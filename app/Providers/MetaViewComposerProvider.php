<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use View;
use Meta;
use App\StoreConfig;
use OpenGraph;
use SEOMeta;

class MetaViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot()
    {
        $this->app['view']->composer(["front.home.index","front.catalog.search","front.catalog.index","front.cart.index","front.cart.order_confirm","front.blog.list"
			,"front.merchant.login","front.auth.login","front.auth.register","front.merchant.register","front.product.ask_product"], function ($view) {
			$language_id = app('language')->language_id;
			$metas = Setting::where('language_id', $language_id)->get();
			foreach ($metas as $meta) {
				switch ($meta->name){
					case "Meta Title":
						SEOMeta::setTitle($meta->value);
					case "Meta Description":
						SEOMeta::setDescription($meta->value);
					case "Meta Keywords":
						SEOMeta::setKeywords($meta->value);
					case "OG Title":
						OpenGraph::setTitle($meta->value);
					case "OG Description":
						OpenGraph::setDescription($meta->value);
				}
			}
        });

        View::composer('front.product.index', function ($view) {
            $view_data = $view->getData();
            $product = $view_data['product'];
            $product = $product->translation; 
			SEOMeta::setTitle($product->meta_title);
			SEOMeta::setDescription($product->meta_description);
			SEOMeta::setKeywords($product->meta_keywords);
			OpenGraph::setTitle($product->og_title);
			OpenGraph::setDescription($product->og_description);
            $view->with('page_type', 'product');
        });

		View::composer('front.page.index', function ($view) {
			$view_data = $view->getData();
			$page = $view_data['page'];
			$language_id = app('language')->language_id;
			SEOMeta::setTitle(($language_id=='1')?$page->english->meta_title : $page->french->meta_title);
			SEOMeta::setDescription(($language_id=='1')? $page->english->meta_description : $page->french->meta_description);
			SEOMeta::setKeywords(($language_id=='1')? $page->english->meta_keywords : $page->french->meta_keywords);
			OpenGraph::setTitle(($language_id=='1')? $page->english->og_title : $page->french->og_title);
			OpenGraph::setDescription(($language_id=='1')? $page->english->og_description : $page->french->og_description);
			$view->with('page_type', 'cms_page');
		});


		View::composer('front.blog.show', function ($view) {
            $view_data = $view->getData();
            $post = $view_data['post'];
			$language_id = app('language')->language_id;
			SEOMeta::setTitle(($language_id=='1')? $post->en_meta_title : $post->fr_meta_title);
			SEOMeta::setDescription(($language_id=='1')? $post->en_meta_description : $post->fr_meta_description);
			SEOMeta::setKeywords(($language_id=='1')? $post->en_meta_keywords : $post->fr_meta_keywords);
			OpenGraph::setTitle(($language_id=='1')? $post->en_og_title : $post->fr_og_title);
			OpenGraph::setDescription(($language_id=='1')? $post->en_og_description : $post->fr_og_description);
            $view->with('page_type', 'blog');
        });
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register()
    {
        //
    }
}
