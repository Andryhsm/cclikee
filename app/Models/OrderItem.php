<?php
/**
 * Created by PhpStorm.
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';
    protected $primaryKey = 'order_item_id';
    public $timestamps = false;
    const ORDER_STATUS_ORDERED=1;
    const ORDER_STATUS_REPLIED=2;
    const ORDER_STATUS_NEGATIVE=3;
    const ORDER_STATUS_WANSWER=4;
    const ORDER_STATUS_FINISHED=5;
    const ORDER_STATUS_CANCELED=6;

    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id','order_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id','product_id');
    }

    public function status()
    {
        return $this->hasOne('App\Models\OrderStatus', 'order_status_id', 'order_status_id');
    }

    public function attributes()
	{
    	return $this->hasMany(OrderItemAttribute::class,'order_item_id');
	}

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','brand_id');
    }

    public function itemRequest()
    {
        return $this->hasMany(OrderItemRequest::class,'item_id','order_item_id');
    }

    public function coupon(){
        return $this->hasOne(OrderItemCoupon::class,'order_item_id','order_item_id');
    }

    public function invoiceItem()
	{
		return $this->hasOne(InvoiceItems::class,'order_item_id','order_item_id');
	}


}
