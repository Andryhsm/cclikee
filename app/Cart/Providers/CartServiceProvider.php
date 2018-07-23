<?php
namespace App\Cart\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     * @return void
     */
    public function register()
    {
        App::bind('App\Cart\Interfaces\CartServiceInterface', function () {
            return new \App\Cart\Services\CartService(app('cart'));
        });
        App::bind('wishlist.cart_service', function () {
            return new \App\Cart\Services\CartService(app('wishlist'));
        });
    }
}
