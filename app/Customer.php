<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'customer';
	/**
	 * @var string
	 */
	protected $primaryKey = 'customer_id';
	/**
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'address', 'postal_code', 'country', 'phone_number', 'email', 'birthday'];
	
}
