<?php

namespace App\Repositories;


use App\Interfaces\OrderItemRequestInterface;
use App\Models\OrderItemRequest;
use App\Encasement;

class ItemRequestRepository implements OrderItemRequestInterface
{
    protected $model;

    public function __construct(OrderItemRequest $order_item_request)
    {
        $this->order_item_request = $order_item_request;
    }

    public function getRequest($user)
    {
        $user_by=($user->role_id==1)?'customer':'merchant';
        return OrderItemRequest::with(['orderItem','user','orderItem.product.url'])->where($user_by.'_id',$user->user_id)->get();
    }

    public function getCustomerRequest($user){
        return OrderItemRequest::with(['orderItem','user','orderItem.product.url','parent','orderItem.attributes'])->where('merchant_id',$user->user_id)->where('is_added_by','customer')->get();
    }

    public function getWaitingRequest($user){
        return OrderItemRequest::with(['orderItem','user','orderItem.product.url','parent'])->where('merchant_id',$user->user_id)->where('is_added_by','merchant')->where('is_booked',0)->get();
    }

    public function getBookedRequest($user){
        return OrderItemRequest::with(['orderItem','user','orderItem.product.url','parent'])->where('merchant_id',$user->user_id)->where('is_booked',1)->get();
    }

    public function getBookedRequestByCustomer($user){
        return OrderItemRequest::with(['orderItem','user','orderItem.product.url','parent'])->where('customer_id',$user->user_id)->where('is_booked',1)->get();
    }

    public function isExists($requets)
    {
        return OrderItemRequest::where('customer_id', $requets['customer'])->whereItemId($requets['item_id'])->whereMerchantId($requets['merchant'])->whereIsAddedBy('customer')->count();
    }

    public function getResponseById($ids){
        return OrderItemRequest::with(['orderItem','user','orderItem.product.url','parent'])->whereIn('parent_id',$ids)->get();
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