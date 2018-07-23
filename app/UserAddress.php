<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
	protected $table = 'user_address';

	protected $primaryKey = 'user_address_id';

	protected $fillable = ['user_id', 'first_name', 'last_name', 'company', 'phone', 'address1', 'address2', 'city', 'state_id', 'country_id', 'zip'];

	public $timestamps = false;
	

}
