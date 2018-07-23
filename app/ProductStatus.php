<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    protected $table = 'product_status';

    protected $primaryKey = 'id';

    protected $fillable = ['status'];

    public $timestamps = false;
}