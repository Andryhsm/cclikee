<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncasementProduct extends Model
{
    /**
	 * @var string
	 */
	protected $table = 'encasement_product';
	/**
	 * @var string
	 */
	protected $primaryKey = 'encasement_id';
	/**
	 * @var array
	 */
	protected $fillable = ['encasement_id', 'attribute_size_id', 'attribute_color_id', 'parent_category', 'sub_category', 'promo_code_id'];

	public function encasement()
	{
		return $this->hasOne(Encasement::class, 'encasement_id', 'encasement_id');
	}
	public function product()
	{
		return $this->hasOne(Product::class, 'product_id', 'product_id');
	}
}
