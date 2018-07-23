<?php

namespace App\Repositories;

use App\Interfaces\OrderItemAttributeInterface;
use App\Models\OrderItemAttribute;

class OrderItemAttributeRepository implements OrderItemAttributeInterface
{
	public function __construct()
	{

	}

	public function saveAttribute($cart_item_attribute, $order_item)
	{
		$order_item_attribute = new OrderItemAttribute();
		$order_item_attribute->attribute_id = $cart_item_attribute->getAttributeId();
		$order_item_attribute->attribute_label = $cart_item_attribute->getLabel();
		$order_item_attribute->product_attribute_option_id = $cart_item_attribute->getProductAttributeOptionId();
		$order_item_attribute->attribute_name = $cart_item_attribute->getLabel();
		$order_item_attribute->attribute_selected_value = $cart_item_attribute->getName();
		$order_item_attribute->attribute_selected_value_price = 0;
		$order_item_attribute->attribute_selected_value_sku = '-';
		$order_item_attribute->attribute_option_id = $cart_item_attribute->getAttributeOptionId();
		$order_item->attributes()->save($order_item_attribute);
	}
}