<?php

namespace App\Providers;

use App\Interfaces\AttributeRepositoryInterface;
use App\Interfaces\AttributeSetRepositoryInterface;
use App\Interfaces\Admin\BrandRepositoryInterface;
use App\Interfaces\AdminUserRepositoryInterface;
use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\BlogCategoryInterface;
use App\Interfaces\BlogPostInterface;
use App\Interfaces\BlogTagInterface;
use App\Interfaces\BrandTagRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use app\interfaces\AdminRoleRepositoryInterface;
use App\Interfaces\EpartnerRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\LanguageInterface;
use App\Interfaces\OrderItemAttributeInterface;
use App\Interfaces\OrderItemCouponInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderItemRequestInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\OrderStatusRepositoryInterface;
use App\Interfaces\OrderTransactionInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\ProductRatingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\RegionRepositoryInterface;
use App\Interfaces\SpecialProductRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\CustomerRepositoryInterface;
use App\Repositories\AttributeRepository;
use App\Repositories\AttributeSetRepository;
use app\Repositories\admin\BrandRepository;
use App\Repositories\AdminUserRepository;
use App\Repositories\BannerRepository;
use App\Repositories\BlogCategoryRepository;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogTagRepository;
use App\Repositories\BrandTagRepository;
use App\Repositories\CategoryRepository;
use app\Repositories\AdminRoleRepository;
use App\Repositories\EpartnerRepository;
use App\Repositories\FaqRepository;
use App\Repositories\InvoiceRepository;
use App\Repositories\ItemRequestRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\OrderItemAttributeRepository;
use App\Repositories\OrderItemCouponRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderStatusRepository;
use App\Repositories\OrderTransactionRepository;
use App\Repositories\PageRepository;
use App\Repositories\ProductRatingRepository;
use App\Repositories\ProductRepository;
use App\Repositories\RegionRepository;
use App\Repositories\SpecialProductRepository;
use App\Repositories\StoreRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ProductStatusRepositoryInterface;
use App\Interfaces\CodePromoRepositoryInterface;
use App\Repositories\ProductStatusRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CodePromoRepository;

class RepositoryServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(ProductRepositoryInterface::class, function ($app) {
			return $app->make(ProductRepository::class);
		});
		$this->app->bind(AttributeRepositoryInterface::class, function ($app) {
			return $app->make(AttributeRepository::class);
		});
		$this->app->bind(AttributeSetRepositoryInterface::class, function ($app) {
			return $app->make(AttributeSetRepository::class);
		});
		$this->app->bind(\App\Interfaces\BrandRepositoryInterface::class, function ($app) {
			return $app->make(\App\Repositories\BrandRepository::class);
		});
		$this->app->bind(AdminUserRepositoryInterface::class, function ($app) {
			return $app->make(AdminUserRepository::class);
		});
		$this->app->bind(CategoryRepositoryInterface::class, function ($app) {
			return $app->make(CategoryRepository::class);
		});
    	$this->app->bind(AdminRoleRepositoryInterface::class, function ($app) {
			return $app->make(AdminRoleRepository::class);
		});
		$this->app->bind(TagRepositoryInterface::class, function ($app) {
			return $app->make(TagRepository::class);
		});
		$this->app->bind(RegionRepositoryInterface::class, function ($app) {
			return $app->make(RegionRepository::class);
		});

		$this->app->bind(OrderStatusRepositoryInterface::class, function ($app) {
			return $app->make(OrderStatusRepository::class);
		});
        $this->app->bind(BrandTagRepositoryInterface::class, function ($app) {
            return $app->make(BrandTagRepository::class);
        });

		$this->app->bind(StoreRepositoryInterface::class, function ($app) {
			return $app->make(StoreRepository::class);
		});

		$this->app->bind(LanguageInterface::class, function ($app) {
			return $app->make(LanguageRepository::class);
		});
        $this->app->bind(SpecialProductRepositoryInterface::class, function ($app) {
            return $app->make(SpecialProductRepository::class);
        });
        $this->app->bind(BannerRepositoryInterface::class, function ($app) {
            return $app->make(BannerRepository::class);
        });
		$this->app->bind(ProductRatingRepositoryInterface::class, function ($app) {
            return $app->make(ProductRatingRepository::class);
        });
		$this->app->bind(UserRepositoryInterface::class, function ($app) {
			return $app->make(UserRepository::class);
		});

		$this->app->bind(OrderRepositoryInterface::class,function ($app){
			return new OrderRepository(
				$app->make(OrderItemRepositoryInterface::class),
				$app->make(OrderTransactionInterface::class)
			);
		});
		$this->app->bind(OrderItemRepositoryInterface::class,function ($app){
			return new OrderItemRepository(
				$app->make(OrderItemAttributeInterface::class),
				$app->make(OrderItemCouponInterface::class)
			);
		});
		$this->app->bind(OrderItemAttributeInterface::class,function ($app){
			return $app->make(OrderItemAttributeRepository::class);
		});
		$this->app->bind(OrderTransactionInterface::class,function ($app){
			return $app->make(OrderTransactionRepository::class);
		});
		$this->app->bind(OrderItemCouponInterface::class,function ($app){
			return $app->make(OrderItemCouponRepository::class);
		});

		$this->app->bind(BlogCategoryInterface::class,function ($app){
			return $app->make(BlogCategoryRepository::class);
		});
		$this->app->bind(BlogPostInterface::class,function ($app){
			return $app->make(BlogPostRepository::class);
		});
		$this->app->bind(BlogTagInterface::class,function ($app){
			return $app->make(BlogTagRepository::class);
		});

		$this->app->bind(OrderItemRequestInterface::class,function ($app){
			return $app->make(ItemRequestRepository::class);
		});
		$this->app->bind(PageRepositoryInterface::class,function ($app){
			return $app->make(PageRepository::class);
		});

		$this->app->bind(FaqRepositoryInterface::class, function ($app){
			return $app->make(FaqRepository::class);
		});

		$this->app->bind(EpartnerRepositoryInterface::class, function ($app){
			return $app->make(EpartnerRepository::class);
		});

		$this->app->bind(InvoiceRepositoryInterface::class, function ($app){
			return $app->make(InvoiceRepository::class);
		});

		$this->app->bind(ProductStatusRepositoryInterface::class, function($app){
			return $app->make(ProductStatusRepository::class);
		});

		$this->app->bind(CustomerRepositoryInterface::class, function($app){
			return $app->make(CustomerRepository::class);
		});

		$this->app->bind(CodePromoRepositoryInterface::class, function($app){
			return $app->make(CodePromoRepository::class);
		});
	}
}
