<?php
namespace App\Http\Controllers\Front;

use App\Events\CouponWasGenerated;
use App\Events\ItemRequest;
use App\Events\ItemRequets;
use App\Http\Controllers\Controller;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderItemRequestInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Coupon;
use App\Models\OrderItem;
use App\Models\OrderItemCoupon;
use App\Models\OrderItemRequest;
use App\User;
use Carbon\Carbon;
use Request;

Class OrderController extends Controller
{
    protected $order_repository;
    protected $order_item_request;
    protected $order_item_repository;

    public function __construct(OrderRepositoryInterface $order_repository, UserRepositoryInterface $user_repository,
                                OrderItemRequestInterface $order_item_request, OrderItemRepositoryInterface $order_item_repository)
    {
        $this->order_repository = $order_repository;
        $this->order_item_repository = $order_item_repository;
        $this->user_repository = $user_repository;
        $this->order_item_request = $order_item_request;

    }

    public function show($order_id)
    {
        $order = $this->order_repository->byId($order_id);
        $stores = [];
        $response=[];
        foreach ($order->orderItems as $item) {
            foreach ($item->brand->stores as $store) {
                $stores[$store->store_id] = $store;
            }
        }
        $requests = $this->order_item_request->getRequest(\Auth::user());
        foreach($requests as $request){
            $response[]=$request->order_item_request_id;
        }
        $item_request=$this->order_item_request->getResponseById($response);
        $booked_request = $this->order_item_request->getBookedRequestByCustomer(\Auth::user());
        return view('front.customer.orders.view', compact('order', 'comments', 'stores', 'order_id', 'item_request','booked_request'))->with('order_id', $order_id);
    }

    public function getCustomerOrders()
    {
    	$user = \Auth::user();
    	$user_id = $user->user_id;
        $pending_items = $this->order_item_repository->itemByStatusAndUser([OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_ORDERED],$user_id);
        $selected_items = $this->order_item_repository->getChoosenItemByUser($user_id);
        $booked_items = $this->order_item_repository->getBookedItemByUser($user_id);
        return view('front.customer.orders.view', compact('pending_items', 'selected_items','booked_items', 'user'));
    }

    public function getLatitudeAndLongitudeByZipCode($zip_code)
    {
        $url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip_code) . "&sensor=false";
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        $result1[] = $result['results'][0];
        $location = $result1[0]['geometry']['location'];
        return $location;
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2, $decimals = 1)
    {
        $theta = $lon1 - $lon2;
        $distance = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        $distance = $distance * 1.609344;
        return round($distance, $decimals);
    }

    public function chooseSeller($merchant_id)
    {
        $request = \Request::all();
        $order_item_request = New OrderItemRequest();
        $order_item_request->customer_id = $request['customer'];
        $order_item_request->item_id = $request['item_id'];
        $order_item_request->merchant_id = $merchant_id;
        $order_item_request->message = NULL;
        $order_item_request->is_added_by = 'customer';
        $order_item_request->created_date = Carbon::now();
        $order_item_request->parent_id = NULL;
		$order_item_request->available_type = $request['available_type'];
		$order_item_request->available_time = $request['available_time'];
		$order_item_request->product_name = $request['product_name'];
		$order_item_request->product_link = $request['product_link'];
        $order_item_request->save();
        $merchant = $this->user_repository->getById($request['merchant']);
        $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_SELECTED, $request['item_id']);
        \Event::fire(New ItemRequest($merchant));
		flash()->success(trans('order.choose_seller_msg'));
	}

    public function getMerchantOrders()
    {
        $users = User::with('store.brands')->whereUserId(\Auth::id())->get();
        $brands = [];
        foreach ($users->first()->store as $store) {
            foreach ($store->brands as $store_brand) {
                $brands[$store_brand->brand_id] = $store_brand->brand_id;
            }
        }
        $ordered_status_items = $this->order_item_repository->getPendingItemsByMerchant($brands,\Auth::user()->user_id);
        $pending_items =$this->getItems($ordered_status_items);
		$waiting_items = $this->order_item_repository->getWaitingItemsByMerchant($brands,\Auth::user()->user_id);
		$earned_items = $this->order_item_repository->getEarnedItemsByMerchant($brands,\Auth::user()->user_id);
        return view('front.merchant.orders.view', compact('pending_items','waiting_items','earned_items'));
    }

    public function getItems($order_items)
    {
        $items = [];
        foreach ($order_items as $item) {
            $location = $this->getLatitudeAndLongitudeByZipCode($item['zip_code']);
            foreach ($item->brand->stores as $store) {
                $distance = $this->calculateDistance($store->latitude, $store->longitude, $location['lat'], $location['lng']);
                if ($item['radius'] >= $distance) {
                    $items[$item['order_item_id']] = $item;
                }
            }
        }
        return $items;

    }

    public function responseToCustomer()
    {
        foreach (\Auth::user()->store as $key => $store) {
            $id_store = $store->store_id;
        }
        $request = Request::all();
        $order_item_request = New OrderItemRequest();
        $order_item_request->customer_id = $request['customer_id'];
        $order_item_request->item_id = $request['item_id'];
        $order_item_request->merchant_id = \Auth::id();
        $order_item_request->message = $request['response'];
        $order_item_request->is_added_by = 'merchant';
        $order_item_request->store_id = $id_store;
        $order_item_request->parent_id = $request['item_request_id'];
        $order_item_request->available_type = $request['available_option_'.$request['item_id']];
		if($request['available_option_'.$request['item_id']]=='2' && !empty($request['available_hours'])){
			$order_item_request->available_time = $request['available_hours'];
		}
		if($request['available_option_'.$request['item_id']]=='5') {
			$order_item_request->product_name = $request['product_name'];
			$order_item_request->product_link = $request['product_link'];
		}
        $order_item_request->created_date = Carbon::now();
        $order_item_request->save();
        $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_REPLIED, $request['item_id']);
        $customer = $this->user_repository->getById($request['customer_id']);
        \Event::fire(New ItemRequest($customer));
        return \Redirect::back();
    }

    public function bookingRequest()
    {
        $request = Request::all();
        $item_request = OrderItemRequest::find($request['request-id']);
        $item_request->is_booked = 1;
        $item_request->booked_date = Carbon::now();
        $item_request->save();
        $coupon_code = $this->generateCouponCode();
        $coupon = $this->saveCoupon($coupon_code, $item_request);
        $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_FINISHED, $item_request->item_id);
        \Event::fire(New CouponWasGenerated($item_request));
//		flash()->success(trans('order.booking_msg'));
		return view('front.customer.coupon', compact('coupon','item_request'));
    }
    public function cancelRequest(\Illuminate\Http\Request $request)
	{
		$request = $request->all();
		$item_request = OrderItemRequest::find($request['request-id']);
		$item_request->is_canceled = 1;
		$item_request->booked_date = Carbon::now();
		$item_request->save();
		$this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_CANCELED, $item_request->item_id);
		flash()->success(trans('order.cancel_msg'));
		return \Redirect::to('customer/request');
	}

    public function coupon(){
    	return view('front.customer.coupon');
	}

    public function saveCoupon($code, $item_request)
    {
        $coupon = New OrderItemCoupon();
        $coupon->order_item_id = $item_request->item_id;
        $coupon->coupon_code=$code;
		$coupon->amount = $item_request->orderItem->final_price;
		$coupon->expiry_date = getCouponExpiryDate($item_request);
        $coupon->save();
		return $coupon;
    }

    private function generateCouponCode($length = 16)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}