<?php

namespace App\Repositories;


use App\Interfaces\OrderItemCouponInterface;
use App\Models\OrderItemCoupon;

class OrderItemCouponRepository implements OrderItemCouponInterface
{

    public function byOrderItemId($id)
    {
        return OrderItemCoupon::find($id)->get();
    }

}