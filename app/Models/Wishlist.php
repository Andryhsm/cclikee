<?php

namespace App\Models;

use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Wishlist extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'wishlists';
	/**
	 * @var string
	 */
	protected $primaryKey = 'wishlist_id';

	const CACHE_TIME_FOR_WISHLIST = 1440; 

	public function product()
	{
		return $this->hasOne(Product::class,'product_id','product_id');
	}

	public function customer()
	{
		return $this->hasOne(User::class,'user_id','user_id');
	}

	public static function user_cookie_id(){
		return Cookie::get('id_user_browser');
	}
}
