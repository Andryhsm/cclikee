<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCustomer extends Model
{
    protected $table = 'encasement_store_customer';
	/**
	 * @var string
	 */
	protected $primaryKey = 'store_user_id';
	/**
	 * @var array
	 */
	protected $fillable = ['user_id', 'store_id', 'type_user'];
    public $timestamps = false;

    const CUSTOMER_SYSTEM_USER = 1;
    const CUSTOMER_LOCAL = 2;
   
}
