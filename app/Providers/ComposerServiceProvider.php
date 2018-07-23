<?php

namespace App\Providers;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\ServiceProvider;
use Cart;
use App\Category;
use App\Models\WishList;
use App\Repositories\CategoryRepository;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    { 
        $category_repository = new CategoryRepository(new Category());
        
        $yes_no_local = "oui";
        View::share('layout','admin.layout.master');
        View::share('categories_search', Category::allFirstChild());
        View::share('local_dev',$yes_no_local);
        View::share('categories_data', $category_repository->getTreeData());
        View::composer('*', function ($view) {
//            $language_code=($this->app->request->is('admin*'))?[]:app('language');
//            $language_code=($this->app->request->is('admin*'))?[]:app()->getLocale();
//            $language_code=($this->app->request->is('admin*'))?[]:\App\Models\Language::where("language_code", 'en')->first();

            $view->with('user', auth()->guard('admin')->user())
//				->with('language',$language_code)
				->with('is_user_login',Auth::check())
				->with('cart_count', Cart::count())
				->with('cart_total', Cart::total())
				->with('recent_items', Cart::recent());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
