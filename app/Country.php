<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'countries';
	/**
	 * @var string
	 */
	protected $primaryKey = 'product_id';
	/**
	 * @var array
	 */
	protected $fillable = ['product_name', 'sku', 'original_price', 'best_price', 'summary', 'description', 'is_active', 'created_by'];

}
