<?php

namespace App\Http\Controllers\Admin;

use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	protected $user_repository;
	protected $product_repository;
	protected $order_repository;
	protected $store_repository;

	public function __construct(UserRepositoryInterface $userRepositoy, ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository, StoreRepositoryInterface $storeRepository)
	{
		$this->user_repository = $userRepositoy;
		$this->product_repository = $productRepository;
		$this->order_repository = $orderRepository;
		$this->store_repository = $storeRepository;
	}

	public function index()
    {
		$product_count = $this->product_repository->getCount();
		$member_count = $this->user_repository->getCountByRole(1);
		$sales_count = $this->order_repository->getCount();
		$store_count = $this->store_repository->getCount();
		$products = $this->product_repository->getDashboardProduct();
		$stores = $this->store_repository->getDashboardStore();
		$members = $this->user_repository->getDashboardCustomers();
		$orders = $this->order_repository->getDashboardOrders();

		return view('admin.dashboard.index',
			compact('product_count', 'member_count', 'sales_count', 'store_count','products','stores','members','orders'));
    }
}
