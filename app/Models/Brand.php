<?php

namespace App\Models;
use App\BrandTag;
use App\Product;
use App\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Brand extends Model
{
    protected $table = 'brand';

    /**
     * @var string
     */
    protected $primaryKey = 'brand_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

	const BRAND_IMAGE_PATH = '/upload/brand/';
	const BRAND_IMAGE_CDN_PATH = 'https://db-alternateeve-csi7douue.stackpathdns.com/upload/brand/';

    protected $fillable = [
        'brand_name',
        'brand_image',
		'website',
		'is_active',
		'created_by'
    ];

	public function tags(){
		return $this->belongsToMany(BrandTag::class,'brand_to_brand_tag','brand_id','brand_tag_id');
	}

	public function children()
	{
		return $this->hasMany(Brand::class, 'parent_id');
	}

	public function parent()
	{
		return $this->hasOne(Brand::class,'brand_id','parent_id');
	}

	public function getImagePath()
	{
		return URL::to('/') . self::BRAND_IMAGE_PATH . $this->brand_image;
	}

	public function getCdnImagePath()
	{
		return self::BRAND_IMAGE_CDN_PATH . $this->brand_image;	
	}

	public function stores()
	{
		return $this->belongsToMany(Store::class, 'store_brands','brand_id','store_id');
	}

	public function scopeActive($query)
	{
		return $query->whereIsActive('1');
	}

	public function products()
	{
		return $this->hasOne(Product::class, 'brand_id', 'brand_id');
	}

	public function admin()
	{
		return $this->hasOne(Admin::class,'admin_id','created_by');
	}

}
