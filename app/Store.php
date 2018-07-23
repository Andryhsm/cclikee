<?php

namespace App;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItemRequest;
use App\Encasement;
use App\EncasementOrderLastReset;

class Store extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'store';
	/**
	 * @var string
	 */
	protected $primaryKey = 'store_id';

	const LOGO_IMG_PATH = 'upload/logo';
	const SHOP_IMG_PATH = 'upload/shop';
	

	public function users()
	{
		return $this->belongsToMany(User::class, 'store_users', 'store_id', 'user_id');
	}

	public function brands()
	{
		return $this->belongsToMany(Brand::class, 'store_brands', 'store_id', 'brand_id');
	}

	public function requestBrand()
	{
		return $this->hasOne(RequestBrand::class,'store_id');
	}

	public function state()
	{
		return $this->hasOne(Region::class,'id','state_id');
	}
	public function country()
	{
		return $this->hasOne(Country::class,'id','country_id');
	}

	public function customers()
	{
		return $this->belongsToMany(User::class, 'encasement_store_customer', 'store_id', 'user_id')->with('address')->where('type_customer', '=', 1);
	}

	public function customersLocal()
	{
		return $this->belongsToMany(\App\Customer::class, 'encasement_store_customer', 'store_id', 'user_id')->where('type_customer', '=', 2);
	}
	
	public function hours()
	{
		return $this->hasMany(\App\StoreOpeningHour::class,'store_id','store_id');	
	}
	
	public function requests()
	{
		return $this->hasMany(OrderItemRequest::class,'store_id','store_id');
	}
	
	public function encasements()
	{
		return $this->hasMany(Encasement::class,'store_id','store_id');
	}
	
	public function encasementorderlastreset()
	{
		return $this->hasOne(EncasementOrderLastReset::class, 'store_id', 'store_id');
	}

}
