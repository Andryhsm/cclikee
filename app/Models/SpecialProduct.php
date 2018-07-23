<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;

use App\Product;
use Illuminate\Database\Eloquent\Model;

class SpecialProduct extends Model
{

    protected $table = 'special_product';
    protected $primaryKey = 'special_product_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'product_id',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id','product_id')->whereIsActive(1);
    }
    public function productTranslation()
    {
        return $this->hasMany(ProductTranslation::class, 'product_id','product_id');
    }

}