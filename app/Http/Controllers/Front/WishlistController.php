<?php

namespace App\Http\Controllers\Front;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class WishlistController extends Controller
{
	protected $model;
    public function __construct(Wishlist $wishlist)
	{
		$this->model = $wishlist;
	}

	public function index()
	{ 
		if(auth()->check()){	
			$products = $this->model->where('user_id',\Auth::user()->user_id)->get();
		}else{
			if(Cookie::has('id_user_browser')){
				$id_user = Cookie::get('id_user_browser');
				$all_wishlist_products = (\Cache::has('wishlist_product')) ? \Cache::get('wishlist_product') : [];
				$products = (array_key_exists($id_user, $all_wishlist_products)) ? $all_wishlist_products[$id_user] : [];
			}else{
				$products = [];
			}
		}
		//dd(Cookie::get('wishlist_product'));
		return view('front.wishlist.list',compact('products'));
	}

	public function store($id,Request $request)
	{ 
		if(auth()->check()){
			$this->model->user_id = \Auth::user()->user_id;
			$this->model->product_id = $id;
			$this->model->save();	
		}else{
			$all_wishlist_products = (\Cache::has('wishlist_product')) ? \Cache::get('wishlist_product') : [];
			$id_user = "";
			$products_user = [];
			$num_of_minutes = 60 * 24 * 7 * 4 * 6; 
			if(Cookie::has('id_user_browser')){
				$id_user = Cookie::get('id_user_browser');
				$products_user = $all_wishlist_products[$id_user]; 	
				$product = new Wishlist();
				$product->product_id = $id;	
				$products_user[$id] = $product;
				$all_wishlist_products[$id_user] = $products_user;
			}else{
				$id_user = strval(mt_rand());
				$product = new Wishlist();
				$product->product_id = $id;	
				$products_user[$id] = $product;
				$all_wishlist_products[$id_user] = $products_user;
			}  
			\Cache::put('wishlist_product', $all_wishlist_products, \App\Models\Wishlist::CACHE_TIME_FOR_WISHLIST);
			Cookie::queue(Cookie::make('id_user_browser', $id_user, $num_of_minutes));
		}
		$nbr_wishlist = (count_wishlist() < 10) ? '0'.count_wishlist() : count_wishlist();
		$nombre_wishlist = (count_wishlist() == 0) ? '01' : $nbr_wishlist;
		return response()->json(['success', $nombre_wishlist]);
		/*flash()->success(trans('product.wishlist_success'));
		return redirect()->back();*/
	}

	public function remove($id)
	{
		if(auth()->check()){
			$this->model->destroy($id);
		}else{
			$id_user = Cookie::get('id_user_browser');
			$all_wishlist_products = (\Cache::has('wishlist_product')) ? \Cache::get('wishlist_product') : [];
			if(!empty($all_wishlist_products)){
				$products_user = (array_key_exists($id_user, $all_wishlist_products)) ? $all_wishlist_products[$id_user] : [];
				if(!empty($products_user))
					unset($products_user[$id]);
				if(array_key_exists($id_user, $all_wishlist_products)){
					$all_wishlist_products[$id_user] = $products_user;
				}
			}
			\Cache::put('wishlist_product', $all_wishlist_products, \App\Models\Wishlist::CACHE_TIME_FOR_WISHLIST);	
		}
		
		$nbr_wishlist = (count_wishlist() < 10) ? '0'.count_wishlist() : count_wishlist();
		return response()->json(['success', $nbr_wishlist]);
		/*flash()->success(trans('product.wishlist_remove'));
		return redirect()->to('wishlist');*/
	}

	function findIdWishlist($ids){
		$tri_id = explode('§',$ids);
		$response = '';   
		if(auth()->check()){ 
		    $id_wishlist = $this->model->select('wishlist_id')->where('product_id','=',$tri_id[0])->where('user_id','=',$tri_id[1])->first();
	    	$response = $id_wishlist->wishlist_id;
		}else{
			$response = $tri_id[0];
		}	
		return response()->json(['success', $response]);
	}
}