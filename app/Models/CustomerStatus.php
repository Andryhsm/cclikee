<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerStatus extends Model
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
	protected $fillable = ['status'];
}
