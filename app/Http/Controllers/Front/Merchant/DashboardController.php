<?php

namespace App\Http\Controllers\Front\Merchant;

use App\Repositories\ItemRequestRepository;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\OrderItemRequestInterface;
use App\Repositories\CustomerRepository;

class DashboardController extends Controller
{
	protected $product_repository;
	protected $order_repository;
	protected $order_item_repository;
	protected $customer_repository;

	public function __construct(CustomerRepository $customer_repo, ProductRepositoryInterface $productRepository, OrderRepositoryInterface $orderRepository, OrderItemRepositoryInterface $orderItemRepository)
	{
		$this->product_repository = $productRepository;
		$this->order_repository = $orderRepository;
		$this->order_item_repository = $orderItemRepository;
		$this->customer_repository = $customer_repo;
	}	

    public function index()
    {	
        $store_id = \Auth::user()->store->first()->store_id;
    	$product_count = $this->product_repository->getCountMerchant($store_id);
    	$sales_count = $this->order_item_repository->getCount($store_id);
    	$total_sales = $this->order_item_repository->getTotalSalesMerchant($store_id);
    	$total_sales_local = $this->customer_repository->getTotalEncasement($store_id);
    	
        return view('merchant.dashboard.index', compact('product_count', 'sales_count', 'total_sales'));
    }
    
    public function statistical()
    {
        $store_id = \Auth::user()->store->first()->store_id;
    	$stat_sales = $this->order_item_repository->getStatSales($store_id);
    	
    	$prices=[];
    	foreach ($stat_sales as $value) {
    		$prices[$value->month]=$value->order_count."$".$value->total_price;
    	}
    	return response()->json($prices);
    }
    
    public function salesInlineLocal()
    {
        $store_id = \Auth::user()->store->first()->store_id;
    	$total_sales = $this->order_item_repository->getTotalSalesMerchant($store_id);
    	$total_sales_local = $this->customer_repository->getTotalEncasement($store_id);
    	
    	$inline = ($total_sales*100)/($total_sales+$total_sales_local);
    	$local = ($total_sales_local*100)/($total_sales+$total_sales_local);
    	return response()->json(['en_ligne'=>$inline,'local'=>$local]);
    	
    }
}
