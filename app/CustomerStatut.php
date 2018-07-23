<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerStatut extends Model
{
   /**
	 * @var string
	 */
	protected $table = 'customer_status';
	/**
	 * @var string
	 */
	protected $primaryKey = 'customer_status_id';
	/**
	 * @var array
	 */
	protected $fillable = ['customer_status_id'];
}
