<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderItemCoupon extends Model
{

    protected $table = 'order_item_coupon';
    protected $primaryKey = 'order_item_id';
    public $timestamps = false;
  
   public function orderItem(){
    return $this->belongsTo('App\Models\orderItem','order_item_id','order_item_id');
   }

  
}