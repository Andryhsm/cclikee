<?php
/**
 * Created by PhpStorm.
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_status';
    protected $primaryKey = 'order_status_is';
    public $timestamps = false;
    
}
