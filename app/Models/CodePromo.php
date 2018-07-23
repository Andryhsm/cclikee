<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Product;

class CodePromo extends Model
{
     protected $table = 'code_promo';

     /**
     * @var string
     */
    protected $primaryKey = 'code_promo_id';

     protected $fillable = [
        'code_promo_name',
        'user_id',
		'date_debut',
		'date_fin',
		'quantity_max'
    ];

    public function categories(){
    	return $this->belongsToMany(Category::class,'code_promo_category','code_promo_id','category_id');
    }
    
    public function products(){
    	return $this->belongsToMany(Product::class,'code_promo_product','code_promo_id','product_id');
    }

}
