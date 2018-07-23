<?php
namespace ShoppingCart;

use Illuminate\Cache\RedisStore;
use ShoppingCart\Storage\StorageInterface;
use ShoppingCart\Cart;
use ShoppingCart\Storage\IlluminateSession;
use Redis;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        //$this->package('shoppingcart', 'shoppingcart', __DIR__);
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->registerSession();
        $this->registerCart();
        $this->registerWishlist();
//        $this->registerCartPermanentStorage();
    }

    /**
     * {@inheritDoc}
     */
    public function provides()
    {
        return ['cart', 'cart.session','wishlist.session', 'cart.permanent','subscription.session'];
    }

    protected function registerCartPermanentStorage()
    {
        $this->app->singleton('cart.permanent',function ($app) {
            $redis = $app['redis'];
            return \Cache::repository(new RedisStore($redis, '', 'cart'));
        });
    }

    /**
     * Register the session driver used by the Cart.
     * @return void
     */
    protected function registerSession()
    {
        $this->app->singleton('cart.session',function ($app) {
            return new IlluminateSession($app['session.store'], null, 'main');
        });
        $this->app->singleton('wishlist.session',function ($app) {
            return new IlluminateSession($app['session.store'], 'wishlist', 'wishlist');
        });
    }

    /**
     * Register the Cart.
     * @return void
     */
    protected function registerCart()
    {
        $this->app->singleton('cart',function ($app) {
            /** @var StorageInterface $cart_session */
            $cart_session = $app['cart.session'];
            $cart = new Cart('main', $cart_session, $app['events']);
            $cart->restore();
            return $cart;
        });
        $this->app->alias('cart', 'ShoppingCart\Cart');
    }

    /**
     * Register the Wishlist.
     * @return void
     */
    protected function registerWishlist()
    {
        $this->app->singleton('wishlist',function ($app) {
            /** @var StorageInterface $wishlist_session */
            $wishlist_session = $app['wishlist.session'];
            $wishlist = new Cart('wishlist', $wishlist_session, $app['events']);
            $wishlist->restore();
            return $wishlist;
        });
    }
}
