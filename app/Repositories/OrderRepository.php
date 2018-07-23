<?php

namespace App\Repositories;


use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderTransactionInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusHistory;
use App\Models\OrderTransaction;
use Carbon\Carbon;

class OrderRepository implements OrderRepositoryInterface
{
	protected $model;
	protected $order_item_repository;
	protected $order_transaction_repository;

	public function __construct(OrderItemRepositoryInterface $order_item_repo, OrderTransactionInterface $order_transaction_repo)
	{
		$this->model = app()->make(Order::class);
		$this->order_item_repository = $order_item_repo;
		$this->order_transaction_repository = $order_transaction_repo;
	}

	public function saveOrder($cart)
	{
		$this->model->user_id = $cart->getCustomer()->user_id;
		$this->model->order_date = Carbon::now();
		$this->model->order_status_id = '1';
		$this->model->subtotal = $cart->total();
		$this->model->discount = 0;
		$this->model->tax = 0;
		$this->model->total = $cart->total();
		$this->model->payment_type = $cart->getPaymentType();
		$this->model->save();
		foreach ($cart->items() as $cart_item_id => $cart_item) {
			$order_item = $this->order_item_repository->saveItem($cart_item, $this->model);
		}

		$order_transaction = new OrderTransaction();
		$order_transaction->order_id = $this->model->order_id;
		$order_transaction->payment_method = 'Cash';
		$order_transaction->amount = $cart->total();
		$order_transaction->created_at = Carbon::now();
		$this->model->transaction()->save($order_transaction);

		$order_status_history = new OrderStatusHistory();
		$order_status_history->order_id = $this->model->order_id;
		$order_status_history->order_item_id = null;
		$order_status_history->order_status_id = '1';
		$order_status_history->status_name = 'On Going';
		$order_status_history->comments = "New Order Placed";
		$order_status_history->user_id = $cart->getCustomer()->user_id;
		$order_status_history->user_name = $cart->getCustomer()->first_name." ".$cart->getCustomer()->last_name;
		$order_status_history->created_at = Carbon::now();
		$order_status_history->save();

		return $this->model;
	}

	public function completedOrders($customer_id)
	{
		return $this->model->where('order_status_id', 2)->where('user_id', $customer_id)->paginate(2);
	}

	public function onGoingOrders($customer_id)
	{
		return $this->model->where('order_status_id', 1)->where('user_id', $customer_id)->get();
	}

	public function byId($order_id)
	{
		return Order::with(['orderItems', 'transaction', 'status', 'orderItems.brand.stores.users','orderItems.attributes'])->where('order_id', $order_id)->get()->first();
	}

	public function getOrders($products_id)
	{
		return OrderItem::with('order')->whereIn('brand_id', $products_id)->paginate(2);
	}
	public function updateStatusById($order_id, $order_status_id)
	{
		return Order::whereOrderId($order_id)->update(['order_status_id' => $order_status_id]);
	}
	public function getCount()
	{
		return Order::count();
	}
	
	public function getDashboardOrders()
	{
		return Order::with('customer')->orderBy('order_id','desc')->limit(12)->get();
	}

	public function getByStatus($status)
	{
		$orders=Order::with('customer','orderItems')
			->where(function ($query) use ($status) {
				if($status==3){
					$query->Where('is_type', '1');
				}else{
					$query->where('order_status_id',$status);
				}
			})->get();
		return $orders;
	}
}