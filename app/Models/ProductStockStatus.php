<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStockStatus extends Model
{
    protected $table = 'product_stock_status';
    protected $primaryKey = 'product_stock_status_id';
    
    protected $fillable = ['status_name'];
    public $timestamps = false;
    
    
}
