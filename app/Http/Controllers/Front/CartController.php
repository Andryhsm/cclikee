<?php

namespace App\Http\Controllers\Front;

use App\Cart\Interfaces\CartServiceInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use Cart;

class CartController extends Controller
{
	protected $product_repository;
	protected $cart_service;
	protected $cart;
	public function __construct(ProductRepositoryInterface $product_repo,CartServiceInterface $cartservice)
	{
		$this->product_repository = $product_repo;
		$this->cart_service = $cartservice;
		$this->cart = app('cart');
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $product = $this->product_repository->getProductById(6);
//		$this->cart_service->add($product,['qty'=>1,'attrs'=>[10,13]]);
 
		$cart = $this->cart;
        return view('front.cart.index',compact('cart'));
    }
	
	public function add(Request $request)
	{
		$product_id = $request->input("product_id");
		$item_id = $request->input('item_id');
		$product = $this->product_repository->getProductById($product_id);
		if ($product == null) {
			flash()->error(trans('cart.item_not_avail'));
			return redirect()->back([400]);
		}
		try {
			if ($item_id == null) {
				$cart_item = $this->cart_service->add($product, $request->all());
			} else {
				$cart_item = $this->cart_service->update($item_id, $product, $request->all());
			}
		} catch (CartException $e) {
			flash()->error($e->getMessage());
			return redirect()->back([400]);
		} catch (\Exception $e) {
			\Log::info($e->getMessage()." error");
		}
		\Log::info("Enregistrement avec success !");
		flash()->success(trans('cart.item_added_success'));
		
		return redirect()->route('cart');
	}


	public function remove($item_id)
	{
		try {
			$this->cart->remove($item_id);
		} catch (CartException $e) {
			flash()->error($e->getMessage());
			return redirect()->back();
		}
		$this->cart->refresh($this->product_repository);
		flash()->success(trans('cart.item_removed_success'));
		return redirect()->route('cart');
	}

	public function update(Request $request)
	{
		foreach ($request->input("qty", []) as $item_id => $qty) {
			if (!$this->cart->exists($item_id)) {
				Session::flash('message.error', CartItem::REMOVED_ITEM_FROM_CART);
				return redirect()->back();
			}

			$item = $this->cart->item($item_id);
			if ($qty == 0) {
				$this->cart->remove($item_id);
			} else {
				$item->setQuantity($qty);
				$this->cart->update($item_id, $item);
			}
		}
		if ($request->has('update_cart')) {
			if ($request->input('update_cart') == 'Update Cart') {
				flash()->success(trans('cart.item_updated_success'));
				return redirect()->route('cart');
			}
		} else {
			return Redirect::to("checkout/shipping-info")->with(['initiatepurchase' => true]);
		}
	}


	public function getRecentItems()
	{
		$items = Cart::recent();
		$recent_items_html =  View::make('checkout.recent')
			->with('items',$items)
			->render();
		$cart_quantity = Cart::cartQuantity();
		return Response::json(['cart_quantity'=>$cart_quantity,'recent_items'=>$recent_items_html]);
	}
	
	

}
