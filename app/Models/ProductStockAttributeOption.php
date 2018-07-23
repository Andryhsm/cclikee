<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttributeOptionTranslation;
use App\AttributeOption;
use App\Models\ProductStock;
use App\Attribute;

class ProductStockAttributeOption extends Model
{
    protected $table = 'product_stock_attribute_option';
    protected $primaryKey = 'product_stock_attribute_option_id';
    
    protected $fillable = ['product_stock_id','attribute_option_id','attribute_id'];
    public $timestamps = false;
    
    public function option()
	{
		return $this->hasOne(AttributeOption::class, 'attribute_option_id', 'attribute_option_id');
	}
	public function stock()
	{
		return $this->hasOne(ProductStock::class, 'product_stock_id','product_stock_id');
	}
    public function attribute(){
        return $this->hasOne(Attribute::class, 'attribute_id','attribute_id');
    }
}
