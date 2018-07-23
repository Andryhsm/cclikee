<?php

namespace App\Http\Controllers\Front;

use App\Interfaces\OrderRepositoryInterface;
use App\Order\Processor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Auth;

class CheckoutController extends Controller
{
	protected $order_processor;
	protected $cart;
	protected $order_repository;
	public function __construct(Processor $processor,OrderRepositoryInterface $order_repo)
	{
		$this->order_processor = $processor;
		$this->cart = app('cart');
		$this->order_repository = $order_repo;
	}

	public function storeOrderInfo(Request $request)
	{
		$cart_product_info = Session::get('cart_product_info');
		$this->cart->setCustomer(Auth::user());
		foreach ($request->input("qty", []) as $item_id => $qty) {
			$item = $this->cart->item($item_id);
			if ($qty == 0) {
				$this->cart->remove($item_id);
			} else {
				$item->setQuantity($qty);
			}
		}
		try {
			$order = $this->order_processor->placeOrder($this->cart, $request->all());
			$this->cart->clear();
			Session::forget('cart_product_info');
			return redirect("checkout/order-confirmed")->with('order_id',$order->order_id);
		} catch (OrderException $e) {
			dd($e->getMessage());
			flash()->error($e->getMessage());
			return redirect("cart");
		}
	}

	public function confirmOrder(Request $request)
	{
		$order_id = $request->session()->get('order_id');
		if(empty($order_id)){
			return redirect('/');
		}
		$order = $this->order_repository->byId($order_id);
		return view('front.cart.order_confirm',compact('order_id','order'));
	}
	
	public function storeQuantitySession(Request $request)
	{
		foreach ($request->input("qty", []) as $item_id => $qty) {
			Session::put($item_id, $qty);
		}
		return response()->json(['success', "Session put ok"]);
	}
	
	public function confirmCart(Request $request)
	{
		Session::put('cart_product_info', $request->all());
		$cart = $this->cart;
        return view('front.cart.confirm_cart',compact('cart'));
	}
	
}
