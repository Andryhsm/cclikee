<?php
namespace App\Cart\Listeners;

use App\User;
use Illuminate\Events\Dispatcher;
use ShoppingCart\Cart;
use ShoppingCart\CartItem;
use Auth;
use Cache;

class CartEventHandler
{
    /**
     * The logged in user instance.
     * @var Customer
     */
    protected $user = null;
    protected $customer_wishlist_repo;

    /**
     * Constructor.
     * @param  Auth $auth
     */
    public function __construct(Auth $auth)
    {
        if ($auth::check()) {
            $this->user = $auth::user();
        } else {
            $this->user = null;
        }
    }

    /**
     * Listen to the events.
     * @param  \Illuminate\Events\Dispatcher $dispatcher
     * @return void
     */
    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen('cart.added', __CLASS__ . '@onItemAdded');
        $dispatcher->listen('cart.updated', __CLASS__ . '@onItemUpdated');
        $dispatcher->listen('cart.removed', __CLASS__ . '@onItemRemoved');
        $dispatcher->listen('cart.cleared', __CLASS__ . '@onCartCleared');
    }

    /**
     * When an item is added to the cart.
     * @param  CartItem $item
     * @param  Cart $cart
     * @return void
     */
    public function onItemAdded(CartItem $item, Cart $cart)
    {
        // Check if the user is logged in
        if (!$this->user) {
            return;
        }
        //Handle object for wishlist - Add data to wishlist table
        if ($cart->getId() == 'wishlist') {
            $wishlist_object = serialize($cart->serialize());
            $this->customer_wishlist_repo->saveWishlist(
                $this->user->customer_id,
                ['wishlist_data' => $wishlist_object]
            );
        }
//        $permanent_storage = app('cart.permanent');
//        $permanent_storage->forever($cart->getId() . '.' . $this->user->user_id, $cart->serialize());
    }

    /**
     * When an item from the cart is updated.
     * @param  CartItem $item
     * @param  Cart $cart
     * @return void
     */
    public function onItemUpdated(CartItem $item, Cart $cart)
    {
        // Check if the user is logged in
        if (!$this->user) {
            return;
        }
        //Handle object for wishlist - Add data to wishlist table
        if ($cart->getId() == 'wishlist') {
            $wishlist_object = serialize($cart->serialize());
            $this->customer_wishlist_repo->saveWishlist(
                $this->user->customer_id,
                ['wishlist_data' => $wishlist_object]
            );
        }
//        $permanent_storage = app('cart.permanent');
//        $permanent_storage->forever($cart->getId() . '.' . $this->user->user_id, $cart->serialize());
    }

    /**
     * When an item is removed from the cart.
     * @param  CartItem $item
     * @param  Cart $cart
     * @return void
     */
    public function onItemRemoved(CartItem $item, Cart $cart)
    {
        // Check if the user is logged in
        if (!$this->user) {
            return;
        }

        if ($cart->getId() == 'wishlist') { //Update Record
            $wishlist_data = serialize($cart->serialize());
            $this->customer_wishlist_repo->saveWishlist(
                $this->user->user_id,
                ['wishlist_data' => $wishlist_data]
            );
        }
//        $permanent_storage = app('cart.permanent');
//        $permanent_storage->forever($cart->getId() . '.' . $this->user->user_id, $cart->serialize());
    }

    /**
     * When the cart is cleared.
     * @param  Cart $cart
     * @return void
     */
    public function onCartCleared(Cart $cart)
    {
        // Check if the user is logged in
        if (!$this->user) {
            return;
        }
//        $permanent_storage = app('cart.permanent');
//        $permanent_storage->forever($cart->getId() . '.' . $this->user->user_id, $cart->serialize());
    }
}
