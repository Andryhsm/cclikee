<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'order_status';
	/**
	 * @var string
	 */
	protected $primaryKey = 'order_status_id';
	/**
	 * @var array
	 */
	protected $fillable = ['status_name', 'customer_status', 'created_by', 'is_default'];

}
