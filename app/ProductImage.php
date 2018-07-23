<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	protected $table = 'product_image';
	/**
	 * @var string
	 */
	protected $primaryKey = 'product_image_id';
	/**
	 * @var array
	 */
	protected $fillable = ['product_id', 'image_name', 'sort_order', 'title', 'alt'];

	public $timestamps = false;

	//
}
