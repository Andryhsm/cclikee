<?php

namespace App\Http\Controllers\Front\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\CouponWasGenerated;
use App\Events\ItemRequest;
use App\Events\ItemRequets;
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
use Jenssegers\Date\Date;

class OrderController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_id = \Auth::user()->store->first()->store_id;
        $ordered_status_items = $this->order_item_repository->getPendingItemsByMerchant($store_id);
        $pending_items =$this->getItems($ordered_status_items);
		$earned_items = $this->order_item_repository->getEarnedItemsByMerchant($store_id);
		$history_items = $this->order_item_repository->getHistoryItemByMerchant($store_id);
		
		return view('merchant.orders.view', compact('pending_items','earned_items','history_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function getItems($order_items)
    {
        $items = [];
        $b=false;
        $d=false;
        //chercher les items
        foreach ($order_items as $item) {
            $country = $item->product->store->country->name;
            $location = $this->getLatitudeAndLongitudeByZipCode($item['zip_code'],$country);
            $distance = $this->calculateDistance($item->product->store->latitude, $item->product->store->longitude, $location['lat'], $location['lng']);
            //condition pour les items autour du zone
            if ($item['radius'] >= $distance) {
                Date::setLocale('fr');
                //cherche les heures d'ouverture
                foreach($item->product->store->hours as $hour){
                    $opening_hour = ($hour->opening_hour!=null)?$hour->opening_hour:'';
                    $closure_hour = ($hour->closure_hour!=null)?$hour->closure_hour:'';
                    //condition pour le jour et heure non null
                    if ($hour->day->day_name == Date::now()->format('l') && $opening_hour!='' && $closure_hour!='') {
                        $d=true;                       
                        $date_jour = Carbon::now()->addHours(1)->format('Y-m-d');
                        
                        $open = Carbon::parse($date_jour." ".$opening_hour);
                        $close = Carbon::parse($date_jour." ".$closure_hour);
                        
                        //condition si la date de commmande est dans la date du jour
                        if (Carbon::parse($item->order_item_date)->gt($open) && Carbon::parse($item->order_item_date)->lt($close)) {
                            //condition si le commerçand ne repond pas dans 1heure
                            if ((Carbon::parse($item->order_item_date)->addHours(1))->gt(Carbon::now())) {
                                $items[$item['order_item_id']] = $item;
                            }else{
                                $b=true;
                            }
                        }else{
                            $b=true;
                        }
                        
                    }
                }
                
                
            }
            if($b == true || $d == false){
                foreach (\Auth::user()->store as $key => $store) {
                    $id_store = $store->store_id;
                }
                $order_item_request = New OrderItemRequest();
                $order_item_request->customer_id = $item->order->user_id;
                $order_item_request->item_id = $item->order_item_id;
                $order_item_request->merchant_id = \Auth::id();
                $order_item_request->is_added_by = 'merchant';
                $order_item_request->store_id = $id_store;
                $order_item_request->available_type = 2;
                $order_item_request->created_date = Carbon::now();
                $order_item_request->save();
                
                $coupon_code = $this->generateCouponCode();
                $coupon = $this->saveCoupon($coupon_code, $order_item_request);
                
                $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_REPLIED, $item->order_item_id);
            }    
        }
        
        return $items;
    }
    public function getLatitudeAndLongitudeByZipCode($zip_code,$country)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $url = "https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAYvJI_Ul_xb9kOGHOtHJ9odVD43OcGz0s&address=" . urlencode($zip_code) . "+".$country."&sensor=false";
        $result_string = file_get_contents($url, false, stream_context_create($arrContextOptions));
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
    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //Reponse to customer
    public function store(Request $request)
    {
        foreach (\Auth::user()->store as $key => $store) {
            $id_store = $store->store_id;
        }
        if ((Carbon::parse($request['order_item_date'])->addHours(1))->gt(Carbon::now())) {
            $order_item_request = New OrderItemRequest();
            $order_item_request->customer_id = $request['customer_id'];
            $order_item_request->item_id = $request['item_id'];
            $order_item_request->merchant_id = \Auth::id();
            $order_item_request->message = $request['response'];
            $order_item_request->is_added_by = 'merchant';
            $order_item_request->store_id = $id_store;
            $order_item_request->parent_id = $request['item_request_id'];
            $order_item_request->available_type = $request['available_option_'.$request['item_id']];
    		/*$order_item_request->is_booked = 1;*/
            /*$order_item_request->booked_date = Carbon::now();*/
            $order_item_request->created_date = Carbon::now();
            $order_item_request->save();
            
            $coupon_code = $this->generateCouponCode();
            $coupon = $this->saveCoupon($coupon_code, $order_item_request);
            
            if($request['available_option_'.$request['item_id']]==1)
            {
                $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_REPLIED, $request['item_id']);    
                flash()->success("Commande disponible !");
            }else{
                $order_item_request->is_canceled = 1;
                $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_NEGATIVE, $request['item_id']);
                flash()->success("Commande indisponible !");
            }
            
            $customer = $this->user_repository->getById($request['customer_id']);
            \Event::fire(New ItemRequest($customer));
            return \Redirect::back();
        }else{
            flash()->warning("Vous avez déjà dépassé le temps de réponse, le produit est consideré comme disponible !");
            return \Redirect::back();
        }
    }
    
    public function bookingRequest($id)
    {
        $item_request = OrderItemRequest::find($id);
        $item_request->is_booked = 1;
        $item_request->booked_date = Carbon::now();
        $item_request->save();
        $this->order_item_repository->updateStatus(OrderItem::ORDER_STATUS_FINISHED, $item_request->orderItem->order_item_id);
		flash()->success("Commande terminer avec succées !");
        return \Redirect::back();
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
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
