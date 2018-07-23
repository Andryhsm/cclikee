<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'order_status_history';
	/**
	 * @var string
	 */
	protected $primaryKey = 'order_status_history_id';

	public $timestamps = false;

	public function order()
	{
		return $this->hasOne(Order::class,'order_id');
	}

	public function orderItem()
	{
		return $this->hasOne(OrderItem::class,'order_item_id');
	}

	public function status()
	{
		return $this->hasOne(OrderStatus::class,'order_status_id');
	}


}
