<?php

namespace App;

use App\Store;
use App\Models\Admin;
use App\Models\AffiliateProduct;
use App\Models\Brand;
use App\Models\CodePromo;
use App\Models\ProductTranslation;
use App\Models\ProductVideo;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Product extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'product';
	/**
	 * @var string
	 */
	protected $primaryKey = 'product_id';
	/**
	 * @var array
	 */
	protected $fillable = ['product_name', 'sku','original_price','best_price','summary','description', 'is_active', 'created_by', 'modified_by', 'question_note'];

	const PRODUCT_IMAGE_PATH = 'upload/product/';
	const THUMB_IMAGE_PATH = 'upload/product/thumb/';

	const PRODUCT_IMAGE_CDN_PATH = 'https://db-alternateeve-csi7douue.stackpathdns.com/upload/product/';
	const THUMB_IMAGE_CDN_PATH = 'https://db-alternateeve-csi7douue.stackpathdns.com/upload/product/thumb/';

	const DEFAULT_NUMBER_PRODUCT_PAGE = 24;
	const DEFAULT_ORDER = '';

	public function categories()
	{
		return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
	}

	public function images()
	{
		return $this
			->hasMany(ProductImage::class,'product_id')
			->orderBy('sort_order');
	}

	public function url()
	{
		return $this->hasOne(Url::class, 'target_id')->whereType(2);
	}
	
	public function store()
	{
		return $this->hasOne(Store::class, 'store_id', 'store_id');
	}

	public function attributeSet()
	{
		return $this->hasOne(AttributeSet::class, 'attribute_set_id');
	}

	public function admin()
	{
		return $this->hasOne(Admin::class, 'admin_id', 'created_by');
	}

	public function admin_editor()
	{
		return $this->hasOne(Admin::class, 'admin_id', 'modified_by');
	}

	public function attributeValues()
	{
		return $this->hasMany(ProductAttributeValue::class,'product_id');
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
	}

	public function translation()
	{
		return $this->hasOne(ProductTranslation::class,'product_id');
	}
	
	/*public function translation($language=null)
	{
		if($language==null){
			return $this->hasMany(ProductTranslation::class,'product_id');
		} else {
			return $this->hasOne(ProductTranslation::class,'product_id')->where('language_id',$language);
		}
	}*/

	/*public function english()
	{
		return $this->translation(1);
	}
	*/
	public function french()
	{
		return $this->translation(2);
	}
	
	public function video()
	{
		return $this->hasMany(ProductVideo::class, 'product_id', 'product_id');
	}

	public function getByLanguageId($language_id)
	{
		$product_translation = $this->translation->filter(function ($value, $key) use ($language_id) {
			return ($value->language_id == $language_id);
		});
		return (count($product_translation) == 0)?$this->translation()->first():$product_translation->first();
	}

	public function getDefaultImagePath()
	{
		if(count($this->images)==0)
			return false;
		return self::PRODUCT_IMAGE_PATH . $this->images[0]->image_name;
	}

	public function getImagesPath($images){
		return self::PRODUCT_IMAGE_PATH . $images->image_name;
	}

	public function getDefaultCdnImagesPath(){
		if(count($this->images)==0)
			return false;
		return self::PRODUCT_IMAGE_CDN_PATH.$this->images[0]->image_name;	
	}

	public function getCdnImagesPath($images){
		return self::PRODUCT_IMAGE_CDN_PATH . $images->image_name;	
	}

	public function thumb($images){
		return self::THUMB_IMAGE_PATH . $images->image_name;
	}

	public function thumbCdn($images){
		return self::THUMB_IMAGE_CDN_PATH . $images->image_name;
	}

	public function brand(){
		return $this->hasOne(Brand::class,'brand_id','brand_id');
	}

	public function getProductAttributeOption($attribute_option_id)
	{
		$product_attribute_option = $this->attributeValues->filter(function ($value,$key) use($attribute_option_id){
			return ($value->attribute_option_id == $attribute_option_id);
		});
		return $product_attribute_option->first();
	}

	public function scopeFilter($q, $param = [], $store_ids)
	{
		$tag_id = isset($param['tag']) ? $param['tag'] : [];  //Input::get('tag');
		$brand_id = isset($param['brand']) ? explode(',', $param['brand']) : [];  //Input::get('brand');
		$start_price = isset($param['start_price']) ? $param['start_price']: '';  //Input::get('start_price');
		$end_price = isset($param['end_price']) ? $param['end_price'] : ''; //Input::get('end_price');
		$size_option_id = isset($param['size']) ? $param['size'] : '';	//Input::get('size');
		$attrs = isset($param['attrs']) ? $param['attrs'] : [];	//Input::get('attrs');
		$attrs = explode_multi(',', $attrs);
		$color_option_id = isset($param['color']) ? explode(',', $param['color']) : [];  //Input::get('color');
		$category_id = (!empty($param['category']) ? $param['category']: '');	//(Input::has('category')) ? Input::get('category') : $category;
		$search_parameter = Input::get('q');
		$discount = isset($param['discount']) ? $param['discount'] : '';	//Input::get('discount');
		//$store_ids = isset($param['brand']) ? explode(',', $param['brand']) : $store_ids;
		$active = 1;
		$active_verified = 5;

        return $q
			->where(function($query) use ($active, $active_verified){
				$query->where('product.is_active', $active)
					->orWhere('product.is_active', $active_verified);
			})		
			->join('product_category', function ($query) use ($tag_id) {
				$query->on('product_category.product_id', '=', 'product.product_id');
			})
			->leftjoin('product_tag', function ($query)  {
				$query->on('product_tag.product_id', '=', 'product.product_id');
			})
			->leftJoin('tag', function ($query) use ($tag_id) {
				$query->on('product_tag.tag_id', '=', 'tag.tag_id');
			})
			->leftjoin('product_translation', function ($query) use ($tag_id) {
				$query->on('product_translation.product_id', '=', 'product.product_id');
			})
			->leftjoin('product_attribute_value as p1', function ($query) {
				$query->on('p1.product_id', '=', 'product.product_id');
			})
			->leftjoin('product_attribute_value as p2', function ($query) {
				$query->on('p2.product_id', '=', 'product.product_id');
			})
			// ->leftjoin('brand as b', function ($query) {
			// 	$query->on('b.brand_id', '=', 'product.brand_id');
			// })
			->leftjoin('product_rating as pr', function ($query) {
				$query->on('pr.product_id', '=', 'product.product_id');
			})
			->where(function ($query) use ($brand_id, $tag_id, $start_price, $end_price, $color_option_id, $size_option_id, $category_id,$search_parameter,$discount, $attrs, $store_ids) {
				if (!empty($store_ids)) {
						$query->where(function ($q) use ($store_ids) {
						$q->whereIn('product.store_id', $store_ids);
					});
				}
				if (!empty($search_parameter)) {
					$query->where('product_name', 'like', '%' . trim($search_parameter) . '%');
				}
				if (!empty($tag_id)) {
					$query->whereIn('tag.tag_id', [$tag_id]);
				}
				if (!empty($start_price) && !empty($end_price)) {
					$query->whereBetween('original_price', [$start_price, $end_price]);
				}
				if (!empty($color_option_id)) {
					$query->whereIn('p1.attribute_option_id', $color_option_id);
				}
				if (!empty($attrs)) {
					$query->whereIn('p2.attribute_option_id', $attrs);
				}
				if (!empty($category_id)) {
					$query->where('product_category.category_id', $category_id);
				}
				//$query->where('product_translation.language_id', app('language')->language_id);
				if(!empty($discount)){
					$query->whereRaw('((100 * (product.original_price - product.best_price))/product.original_price) >='.$discount);
				}

			})
			->groupBy('product.product_id');
    }

    public function affiliate()
	{
    	return $this->hasMany(AffiliateProduct::class,'product_id','product_id')->orderBy('price');
	}
	public function code_promos()
	{
    	return $this->belongsToMany(CodePromo::class,'code_promo_product','product_id','code_promo_id');
    }
    public function stocks()
    {
    	return $this->hasMany(ProductStock::class,'product_id','product_id');
    }

}
