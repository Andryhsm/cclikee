<?php

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'product_translation';

	protected $primaryKey = 'product_translation_id';


	public $timestamps = false;
	protected $guarded = [];

	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}

	public function products()
	{
		return $this->belongsTo(Product::class,'product_id','product_id');
	}

}
