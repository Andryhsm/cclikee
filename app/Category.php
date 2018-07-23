<?php

namespace App;

use App\Models\Brand;
use App\Models\CodePromo;
use App\Models\CategoryTranslation;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'category';
	/**
	 * @var string
	 */
	protected $primaryKey = 'category_id';
	/**
	 * @var array
	 */
	protected $fillable = ['category_name', 'description', 'parent_id', 'is_active', 'category_image', 'created_by'];

	const CATEGORY_IMAGE_PATH = '/upload/category/';
	const CDN_CATEGORY_IMAGE_PATH = 'https://db-alternateeve-csi7douue.stackpathdns.com/upload/category/';

	public function products()
	{
		return $this->belongsToMany(Product::class, 'product_category', 'category_id', 'product_id');
		//->orderBy('sort_order');
	}

	public function parent()
	{
		return $this->hasOne(Category::class, 'category_id', 'parent_id');
	}

	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}

	public function brand()
	{
		return $this->hasOne(Brand::class, 'brand_id');
	}

	public function url()
	{
		return $this->hasOne(Url::class, 'target_id')->whereType(1);
	}

	public function translation($language=null)
	{
		if($language==null){
			return $this->hasMany(CategoryTranslation::class,'category_id');
		} else {
			return $this->hasOne(CategoryTranslation::class,'category_id')->where('language_id',$language);
		}
	}

	public function english()
	{
		return $this->translation(1);
	}

	public function french()
	{
		return $this->translation(2);
	}

	public function scopeActive($query){
		return $query->whereIsActive('1');
	}

    public function getByLanguage($language_id){
       $category_translation= $this->translation->filter(function ($value, $key) use($language_id) {
           return ($value->language_id==$language_id);
        });

        return (count($category_translation)==0)?$this->translation->first():$category_translation->first();

    }
    //Avoir le premier enfant de la categorie pour la liste deroulant de la bare de la recherche
    public function scopeAllFirstChild($language_id)
    {
    	$parent_categories = Category::with('translation','url','children')->where('parent_id',null)->active()->orderBY('sort_order')->get();
        $categories_search_fr = [];							//liste deroulant fr
        $categories_search_en = [];         			    //liste deroulant en                                                            
        $categories_search_fr[] = 'Tout';	
        $categories_search_en[] = 'All'; 
        foreach ($parent_categories as $parent_category) {
            $categories_search_fr[$parent_category->category_id] = $parent_category->french->category_name;
            $categories_search_en[$parent_category->category_id] = $parent_category->english->category_name;
            
        }
        return ['fr' => $categories_search_fr, 'en' => $categories_search_en];
    }

    public function getImagePath($image)
    {
    	return self::CATEGORY_IMAGE_PATH . $image;
    }

    public function getCdnImagePath($image)
    {
    	return self::CDN_CATEGORY_IMAGE_PATH . $image;
    }

    public function code_promos(){
    	return $this->belongsToMany(CodePromo::class,'code_promo_category','category_id','code_promo_id');
    }
}
