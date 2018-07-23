<?php

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = [];
    protected $orderBy = 'order_id';
    protected $orderDirection = 'DESC';
	public $timestamps = false;

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function customer()
    {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }   

    public function billingAddress()
    {
        return $this->hasOne(OrderBilling::class, 'order_id', 'order_id');
    }

    public function transaction()
    {
        return $this->hasOne(OrderTransaction::class, 'order_id', 'order_id');
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'order_status_id', 'order_status_id');
    }

}
