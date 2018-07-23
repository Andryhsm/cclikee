<?php

namespace App\Repositories;


use App\Interfaces\OrderItemAttributeInterface;
use App\Interfaces\OrderItemCouponInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use App\Models\OrderItemRequest;
use App\Encasement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class OrderItemRepository implements OrderItemRepositoryInterface
{
	protected $order_item_attribute_repository;
	protected $order_item_coupon_repository;

	public function __construct(OrderItemAttributeInterface $order_item_attribute, OrderItemCouponInterface $order_item_coupon)
	{
		$this->order_item_attribute_repository = $order_item_attribute;
		$this->order_item_coupon_repository = $order_item_coupon;
	}

	public function saveItem($cart_item, $order)
	{
		$order_item = new OrderItem();
		$order_item->product_id = $cart_item->getId();
		$order_item->product_name = $cart_item->getName();
		$order_item->product_sku = $cart_item->getSku();
		$order_item->quantity = $cart_item->getQuantity();
		$order_item->price = $cart_item->getOriginalPrice();
		$order_item->discount = 0;
		$order_item->final_price = $cart_item->getTotal();
		$order_item->attribute_sku = '';
		$order_item->attribute_price = 0;
		$order_item->tax = 0;
		$order_item->radius = Cookie::has('radius') ? Cookie::get('radius') : '';
		$order_item->zip_code = Cookie::has('zip-code') ? Cookie::get('zip-code') : '';
		$order_item->brand_id = $cart_item->getBrand();
		$order_item->order_status_id = '1';
		$order_item->product_url = $cart_item->getProduct()->url;
		$order_item->order_item_date = Carbon::now();
		$order->orderItems()->save($order_item);
		foreach ($cart_item->getAttributes() as $cart_item_attribute) {
			$this->order_item_attribute_repository->saveAttribute($cart_item_attribute, $order_item);
		}
		return $order_item;
	}

    public function ByStatus($status_id,$brands)
    {
		$status_id = !is_array($status_id)? [$status_id]:$status_id;
        return OrderItem::with(['brand.stores', 'product', 'attributes','itemRequest','coupon'])->whereIn('order_status_id',$status_id)->whereIn('brand_id', $brands)->get();
    }

    public function updateStatus($status_id, $order_item_id)
    {
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_status_id = $status_id;
        $order_item->save();
    }

	public function getItemByStatus($status_id)
	{
		return OrderItem::with(['brand.stores', 'product', 'attributes','itemRequest.user.store'])->whereOrderStatusId($status_id)->get();
	}

	public function getPendingItemsByMerchant($store_id)
	{
		$items = OrderItem::whereNotExists(function($query) use ($store_id)
		{
			$query->select('*')
				->from('order_item_request')
				->whereRaw('order_item_request.item_id= order_item.order_item_id')
				->where('order_item_request.store_id','=',$store_id);
		})
			->with(['brand','brand.stores', 'product', 'product.store.hours', 'attributes'])
			->where('order_status_id',OrderItem::ORDER_STATUS_ORDERED)
			->orderBy('order_item_id','desc')
			->get();
		return $items;
	}

	public function getWaitingItemsByMerchant($brands, $user_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($user_id){
			$query->where('merchant_id',$user_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('merchant_id',$user_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_WANSWER])
			->whereIn('brand_id', $brands)
			->get();
		return $items;
	}

	public function getEarnedItemsByMerchant($store_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($store_id){
			$query->where('store_id',$store_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($store_id){
				$query->where('store_id',$store_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->where('order_status_id',OrderItem::ORDER_STATUS_REPLIED)
			->orderBy('order_item_id','desc')
			->get();
		return $items;
	}
	
	public function getHistoryItemByMerchant($store_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($store_id){
			$query->where('store_id',$store_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($store_id){
				$query->where('store_id',$store_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->where('order_status_id',OrderItem::ORDER_STATUS_FINISHED)
			->orderBy('order_item_id','desc')
			->get();
		return $items;
		
	}
	
	public function getCount($store_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($store_id){
			$query->where('store_id',$store_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($store_id){
				$query->where('store_id',$user_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_FINISHED])
			->orderBy('order_item_id','desc')
			->count();
		return $items;
	}
	
	public function getStatSales($store_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($store_id){
			$query->where('store_id',$store_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($store_id){
				$query->where('store_id',$store_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_FINISHED])
			->select(\DB::raw('count(*) as order_count'), \DB::raw('MONTH(order_item_date) as month'), \DB::raw('sum(final_price) as total_price'))
			->whereYear('order_item_date', '=', date('Y'))
            ->groupBy('month')
            ->get();
		return $items;
	}
	
	/*public function getAllRequest(){
		
		$items = OrderItem::whereHas('itemRequest',function($query){
			$query->where('is_added_by','merchant');
			$query->where('is_canceled',0);
			})
			->join('order_item_request', 'order_item.order_item_id', '=', 'order_item_request.item_id')
			->with(['product','itemRequest'=>function($query){
				$query->where('is_added_by',"merchant");
				$query->where('is_canceled',0);
			}])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_FINISHED])
			->select(\DB::raw('order_item_request.store_id as store_id'), \DB::raw('count(*) as order_count'), \DB::raw('sum(final_price) as total_price'))
			->groupBy('order_item_request.store_id')
			->get();
		return $items;
		
    }*/
	
	public function getTotalSalesMerchant($store_id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query) use($store_id){
			$query->where('store_id',$store_id);
			$query->where('is_added_by','merchant');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($store_id){
				$query->where('store_id',$store_id);
				$query->where('is_added_by',"merchant");
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_FINISHED])
			->orderBy('order_item_id','desc')
			->sum('final_price');
		return $items;
	}
	
	public function itemByStatusAndUser($status_id, $user_id)
	{
		$status_id = is_array($status_id) ? $status_id : [$status_id];
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest.user.store'])
			->whereIn('order_status_id',$status_id)
			->orderBy('order_item_id','desc')
			->get();
		return $items;
	}

	public function getChoosenItemByUser($user_id)
	{
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})->whereHas('itemRequest',function($query) use($user_id){
			$query->where('customer_id',$user_id);
			$query->where('is_added_by','customer');
			$query->where('is_booked','0');
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('customer_id',$user_id);
				$query->where('is_added_by',"customer");
				$query->where('is_booked','0');
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_REPLIED,OrderItem::ORDER_STATUS_WANSWER])
			->get();
		return $items;
	}

	public function getBookedItemByUser($user_id)
	{
		$items = OrderItem::whereHas('order',function($query) use($user_id){
			$query->where('user_id',$user_id);
		})->whereHas('itemRequest',function($query) use($user_id){
			$query->where('customer_id',$user_id);
			$query->where('is_added_by','merchant');
			$query->where(function ($q) {
				$q->where('is_booked', '1');
				$q->orWhere('is_canceled', '1');
			});
		})
			->with(['brand','brand.stores', 'product', 'attributes','itemRequest'=>function($query) use($user_id){
				$query->where('customer_id',$user_id);
				$query->where('is_added_by',"merchant");
				$query->where(function ($q) {
					$q->where('is_booked', '1');
					$q->orWhere('is_canceled', '1');
				});
			},'coupon'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_FINISHED,OrderItem::ORDER_STATUS_CANCELED])
			->get();
		return $items;
	}

	public function getAllInvoiceItems()
	{
		return OrderItem::where('order_status_id',OrderItem::ORDER_STATUS_FINISHED)->get();
	}

	public function getAllBookedItems()
	{
		$items = OrderItem::whereHas('itemRequest',function($query){
			$query->where('is_added_by','customer');
			$query->where('is_booked','1');
		})
			->with(['brand.stores', 'product','itemRequest'=>function($query){
				$query->where('is_added_by',"customer");
				$query->where('is_booked','1');
			},'itemRequest.merchant','invoiceItem','invoiceItem.invoice'])
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_FINISHED])
			->get();
		return $items;
	}
	public function getItemById($id)
	{
		$items = OrderItem::with(['order', 'product','product.store', 'attributes','invoiceItem','invoiceItem.invoice'])
			->where('order_item_id',$id)
			->first();
		return $items;
	}
	
	public function getBookedItemById($id)
	{
		$items = OrderItem::whereHas('itemRequest',function($query){
			$query->where('is_added_by','customer');
			$query->where('is_booked','1');
		})
			->with(['order', 'product','itemRequest'=>function($query){
				$query->where('is_added_by',"customer");
				$query->where('is_booked','1');
			},'itemRequest.merchant','invoiceItem','invoiceItem.invoice'])
			->where('order_item_id',$id)
			->whereIn('order_status_id',[OrderItem::ORDER_STATUS_FINISHED])
			->first();
		return $items;
	}
	
	public function resetOrderItemAccounting($id)
	{
		if(isset($id)){
			$order_item_request = OrderItemRequest::where('store_id', $id)->get();
			foreach ($order_item_request as $order) {
				$order->reset_accounting = 1;
				$order->save();
			}
		}
		
	}
	public function resetEncasementAccounting($id)
	{
		if(isset($id)){
			$encasement = Encasement::where('store_id', $id)->get();
			foreach ($encasement as $encase) {
				$encase->reset_accounting = 1;
				$encase->save();
			}
		}
		
	}
}