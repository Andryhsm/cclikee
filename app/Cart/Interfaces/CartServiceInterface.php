<?php
namespace App\Cart\Interfaces;

use App\Product;
use ShoppingCart\CartItem;

interface CartServiceInterface
{
    public function add(Product $product, $form);

    public function update($item_id, Product $product, $form);

    /**
     * @param CartItem $item
     * @param $quantity
     * @return mixed
     */
    public function addItem(CartItem $item, $quantity);
}
