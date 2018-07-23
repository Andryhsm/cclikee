<?php

namespace App;

use App\Models\Brand;
use App\Models\BrandCategory;
use Illuminate\Database\Eloquent\Model;

class BrandTag extends Model
{
	protected $table = 'brand_tag';
	/**
	 * @var string
	 */
	protected $primaryKey = 'brand_tag_id';
	/**
	 * @var array
	 */
	protected $fillable = ['tag_name'];
    public $timestamps = false;

	public function brands(){
		return $this->belongsToMany(Brand::class,'brand_to_brand_tag','brand_tag_id','brand_id');
	}

}
