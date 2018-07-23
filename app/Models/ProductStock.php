<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductStockAttributeOption;
use App\Attribute;

class ProductStock extends Model
{
    protected $table = 'product_stock';
    protected $primaryKey = 'product_stock_id';
    
    protected $fillable = ['product_id', 'store_id', 'product_count', 'product_stock_status_id'];
    public $timestamps = false;
    
    
    public function options(){
        return $this->hasMany(ProductStockAttributeOption::class, 'product_stock_id');
    }
    
    public function attribute_option($attribute_option_ids = []){
        return $this->join('product_stock_attribute_option', function($query){
            $query->on('product_stock_id', '=', 'product_stock_id');
        })
        ->where(function($query){
           foreach($attribute_option_ids as $attribute_option_id){
               $query->where('product_stock_attribute_option_id', '=', $attribute_option_id);
           }
        })->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
}
