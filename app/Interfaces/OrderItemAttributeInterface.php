<?php

namespace App\Interfaces;


interface OrderItemAttributeInterface
{
	public function saveAttribute($cart_item_attribute,$order_item);
}