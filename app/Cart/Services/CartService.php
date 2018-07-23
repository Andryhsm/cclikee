<?php
namespace App\Cart\Services;

use App\Cart\Interfaces\CartServiceInterface;
use ShoppingCart\CartItem;
use App\Product;
use ShoppingCart\Cart;
use App;

class CartService implements CartServiceInterface
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    protected function validate(Product $product, $form)
    {
        $cart_validators = App::make('cart.validators');
        foreach ($cart_validators as $cart_validator) {
            $cart_validator->validate($product, $form);
        }
    }

    /**
     * Add product to cart.
     * @param \App\Models\Product $product
     * @param                     $form
     * @return CartItem
     */
    public function add(Product $product, $form)
    {
        $form = $this->cleanupForm($form);
        $this->validate($product, $form);
        $cart_item = new CartItem();
        $cart_item->init($product, $form);
        $this->cart->add($cart_item);
        return $cart_item;
    }

    /**
     * Add product to cart.
     * @param \App\Models\Product $product
     * @param                     $form
     * @return CartItem
     */
    public function addGroupedProduct(Product $product, $form)
    {
        $form = $this->cleanupForm($form);
        $cart_item = new CartItem();
        $cart_item->init($product, $form);
        $this->cart->add($cart_item);
        return $cart_item;
    }

    /**
     * @param CartItem $item
     * @param $quantity
     * @return CartItem
     */
    public function addItem(CartItem $item, $quantity)
    {
        $item->setQuantity($quantity);
        $this->cart->add($item);
        return $item;
    }

    public function update($item_id, Product $product, $form)
    {
        $form = $this->cleanupForm($form);
        $this->validate($product, $form);
        $cart_item = new CartItem();
        $cart_item->init($product, $form);
        $this->cart->update($item_id, $cart_item);
        return $cart_item;
    }

    public function cleanupForm($form)
    {
        if (isset($form['step_1'])) {
            $step1 = [];
            parse_str($form['step_1'], $step1);
            $form['step_1'] = $step1;
        }
        if (isset($form['step_2'])) {
            $step2 = [];
            parse_str($form['step_2'], $step2);
            $form['step_2'] = $step2;
        }
        if (isset($form['step_3'])) {
            $step3 = [];
            parse_str($form['step_3'], $step3);
            $form['step_3'] = $step3;
        }
        return $form;
    }
}
