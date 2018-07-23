<?php namespace App\Listeners;

use App\Exceptions\CartException;
use App\Repositories\ProductRepository;
use App\User;
use ShoppingCart\Cart;
use Illuminate\Events\Dispatcher;
use Cache;
use ShoppingCart\Storage\LocalStore;
use Session;

class UserEventHandler
{
    /**
     * @var Cart
     */
    protected $cart;
    /**
     * @var Cart
     */
    protected $wishlist;
    protected $customer_wishlist_repo;

    public function __construct()
    {

    }

    /**
     * Listen to the events.
     * @param  \Illuminate\Events\Dispatcher $dispatcher
     * @return void
     */
    public function subscribe(Dispatcher $dispatcher)
    {
        $dispatcher->listen('Illuminate\Auth\Events\Login', __CLASS__ . '@onUserAuthenticated');
    }

    /**
     * When a user logs in.
     * @param  Customer $user
     * @return void
     */
    public function onUserAuthenticated($event)
    {
    	if(is_a($event->user,User::class)){
			$this->syncFromDatabase($event->user);
			$this->syncToDatabase($event->user);
//        $this->syncWishlistFromDatabase($event->user);
//        $this->syncWishlistToDatabase($event->user);
		}
    }

    // Syncs the items we have on the database to the cart
    protected function syncFromDatabase(User $user)
    {
        $cart = app('cart');
        $permanent_storage = app('cart.permanent');
        $_user_data = $permanent_storage->get($cart->getId() . '.' . $user->user_id);
        if ($_user_data == null) {
            //check sql db
            return;
        }
        $storage = new LocalStore();
        $storage->put($_user_data);
        $_cart = new Cart('', $storage, null);
        $_cart->restore();
        $cart->sync($_cart->items());
        $cart->setCustomer($user);
    }

    // Syncs the items we have on the cart to the database
    protected function syncToDatabase(User $user)
    {
        $cart = app('cart');
        try {
            $cart->refresh(app()->make(ProductRepository::class));
        } catch (CartException $e) {
            Session::flash('message.error', $e->getMessage());
        }

        $permanent_storage = app('cart.permanent');
        $permanent_storage->forever($cart->getId() . '.' . $user->user_id, $cart->serialize());
    }

    // Syncs the items we have on the database to the wishlist
    protected function syncWishlistFromDatabase(User $user)
    {
        $wishlist = app('wishlist');
        //check sql db
        $wishlist_data = $this->customer_wishlist_repo->getWishlistByCustomerId($user->user_id);
        if (!$wishlist_data->isEmpty()) {
            $customer_wishlist = unserialize($wishlist_data);
        }
        if (empty($customer_wishlist) || $customer_wishlist == null) {
            return;
        }
        $storage = new LocalStore();
        $storage->put($customer_wishlist);
        $_cart = new Cart('wishlist', $storage, null);
        $_cart->restore();
        $wishlist->sync($_cart->items());
    }

    // Syncs the items we have on the wishlist to the database
    protected function syncWishlistToDatabase(User $user)
    {
        $wishlist = app('wishlist');
        $wishlist->refresh(app('ProductRepository'));

        //Store into database
        if (!$wishlist->items()->isEmpty()) {
            $wishlist_object = serialize($wishlist->serialize());
            $this->customer_wishlist_repo->saveWishlist(
                $user->user_id,
                ['wishlist_data' => $wishlist_object]
            );
        }
    }
}
