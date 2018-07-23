<?php

namespace App\Cart\Providers;

use App\Product\Validators\DonationValidator;
use App\Product\Validators\InventoryValidator;
use App\Product\Validators\PersonalizationValidator;
use App\Product\Validators\AttributeValidator;
use Illuminate\Support\ServiceProvider;
use Auth;

class CartValidatorProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->app->bind('cart.validators', function ($app) {
            return [
            ];
        });
    }
}
