<?php

namespace App\Http\Controllers\Front;

use App\Interfaces\InvoiceRepositoryInterface;
use App\Interfaces\OrderItemRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Repositories\UserRepository;
use App\User;
use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Request;


class MerchantController extends Controller
{
	protected $user_repository;
	protected $store_repository;
	protected $order_item_repository;
	protected $invoice_repository;
	protected $stripe_key;

	public function __construct(UserRepositoryInterface $user_repo, StoreRepositoryInterface $store_repo, OrderItemRepositoryInterface $order_item_repo, InvoiceRepositoryInterface $invoice_repo)
	{
		$this->user_repository = $user_repo;
		$this->store_repository = $store_repo;
		$this->order_item_repository = $order_item_repo;
		$this->invoice_repository = $invoice_repo;
		$this->stripe_key = config('services.stripe.secret');
	}

	public function index()
	{
		$user_id = Auth::id();
		$customer = $this->user_repository->getById($user_id);
		$stripe = Stripe::make($this->stripe_key);
		$cards = $stripe->cards()->all($customer->stripe_id);
		return view('front.merchant.index', compact('customer','cards'));
	}

	public function getStores()
	{
		$stores = $this->store_repository->getByUserId(Auth::id());
		return view('front.merchant.store', compact('stores'));
	}

	public function getOrders(Request $request)
	{
		$users = User::with('store.brands')->whereUserId(\Auth::id())->get();
		$brands = [];
		foreach ($users->first()->store as $store) {
			foreach ($store->brands as $store_brand) {
				$brands[$store_brand->brand_id] = $store_brand->brand_id;
			}
		}
		$ordered_status_items = $this->order_item_repository->ByStatus(OrderItem::ORDER_STATUS_ORDERED, $brands);
		$items = $this->getItems($ordered_status_items);
		$data = array();
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$collection = new Collection($items);
		$per_page = 2;
		$currentPageResults = $collection->slice(($currentPage - 1) * $per_page, $per_page)->all();
		$data['results'] = new LengthAwarePaginator($currentPageResults, count($collection), $per_page);
		$data['results']->setPath(Request::url());
		return view('front.merchant.orders.completed')->with('results', $data['results']);
	}

	public function getItems($order_items)
	{
		$items = [];
		foreach ($order_items as $item) {
			$location = $this->getLatitudeAndLongitudeByZipCode($item['zip_code']);
			foreach ($item->brand->stores as $store) {
				$distance = $this->calculateDistance($store->latitude, $store->longitude, $location['lat'], $location['lng']);
				if ($item['radius'] >= $distance) {
					$items[$item['order_item_id']] = $item;
				}
			}
		}
		return $items;
	}

	public function getLatitudeAndLongitudeByZipCode($zip_code)
	{
		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($zip_code) . "&sensor=false";
		$result_string = file_get_contents($url);
		$result = json_decode($result_string, true);
		$result1[] = $result['results'][0];
		$location = $result1[0]['geometry']['location'];
		return $location;
	}

	public function calculateDistance($lat1, $lon1, $lat2, $lon2, $decimals = 1)
	{
		$theta = $lon1 - $lon2;
		$distance = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
		$distance = acos($distance);
		$distance = rad2deg($distance);
		$distance = $distance * 60 * 1.1515;
		$distance = $distance * 1.609344;
		return round($distance, $decimals);
	}

	public function invoices()
	{
		$invoices = $this->invoice_repository->getAllByPaginate();
		return view('front.merchant.invoice',compact('invoices'));
	}

	public function viewInvoice($id)
	{
		$invoice = $this->invoice_repository->getById($id);
		return view('front.merchant.invoice_detail',compact('invoice'));
	}

	public function addCard(\Illuminate\Http\Request $request)
	{
		$merchant_stripe_id = Auth::user()->stripe_id;
		$stripe = Stripe::make($this->stripe_key);
		$card = $stripe->cards()->create($merchant_stripe_id, $request->get('stripeToken'));
		if(!empty($card)){
			flash()->success(trans('merchant.card_info_updated'));
			return redirect('merchant');
		}
		return redirect('merchant');
	}

	public function payInvoice($id,\Illuminate\Http\Request $request)
	{
		$invoce = $this->invoice_repository->getById($id);
		$stripe = Stripe::make($this->stripe_key);
		$status = $stripe->invoices()->pay($invoce->stripe_id);
		if($status){
			Invoice::where('id',$id)->update(['status'=>'1']);
			flash()->success(trans('merchant.invoice_paid'));
			return redirect('merchant');
		}
		return redirect('merchant');
	}


}
