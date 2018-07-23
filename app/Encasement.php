<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encasement extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'encasement';
	/**
	 * @var string
	 */
	protected $primaryKey = 'encasement_id';
	/**
	 * @var array
	 */
	protected $fillable = ['user_id', 'store_id', 'discount', 'total_ht', 'total_ttc', 'discount', 'tva', 'quantity', 'reset_accounting'];
		
	const CANNOT_RESET = 1;
    const CAN_RESET = 0;
	
	public function products()
	{
		return $this->hasMany(Product::class, 'product_id', 'product_id');
	}

	public function user()
	{
		return $this->hasOne(Customer::class,'user_id','user_id');
	}
}
