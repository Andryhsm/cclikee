<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'product_attribute_value';
	/**
	 * @var string
	 */
	protected $primaryKey = 'product_attribute_option_id';

	public $timestamps = false;

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'product_id');
	}

	public function option()
	{
		return $this->hasOne(AttributeOption::class, 'attribute_option_id', 'attribute_option_id');
	}

	public function attribute()
	{
		return $this->hasOne(Attribute::class, 'attribute_id', 'attribute_id');
	}
}
