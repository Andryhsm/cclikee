<?php
namespace App\Http\Controllers;

use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\BlogPostInterface;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SpecialProductRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $category_repository;
    protected $banner_repository;
    protected $brand_repository;
    protected $special_product_repository;
	protected $blog_repository;

    public function __construct(CategoryRepositoryInterface $category_repository, BannerRepositoryInterface $banner_repository,BrandRepositoryInterface $brand_repository,
								SpecialProductRepositoryInterface $special_product_repository,
								BlogPostInterface $blog_repo
	)
    {
        $this->category_repository = $category_repository;
        $this->banner_repository = $banner_repository;
        $this->brand_repository = $brand_repository;
        $this->special_product_repository = $special_product_repository;
		$this->blog_repository = $blog_repo;
    }
    public function index()
    {
        $language_id=app('language')->language_id;
        $categories = $this->category_repository->getParentCategories($language_id);
        $banner = $this->banner_repository->getActiveMainBanner($language_id);
		$sub_banners = $this->banner_repository->getActiveSubBanner($language_id);
        $sliders = $this->banner_repository->getActiveSlider($language_id);
        $brands=$this->brand_repository->getAll();
        $special_products=$this->special_product_repository->getspecialProducts();
		$blog_posts = $this->blog_repository->getHomePagePost();
        return view('front.home.index', compact('categories','banner','sliders','brands','sub_banners','special_products','blog_posts'));
    }
}
