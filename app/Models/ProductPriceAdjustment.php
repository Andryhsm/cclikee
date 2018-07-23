<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use App\Product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductPriceAdjustment extends Model
{

    protected $table = 'product_price_adjustment';
    protected $primaryKey = 'product_price_adjustment_id';
    public $timestamps = false;

    public function product(){
        return $this->hasOne(Product::class,'product_id','product_id');
    }

    public function user(){
        return $this->hasOne(User::class,'user_id','user_id');
    }

}