<?php
/**
 * Created by PhpStorm.
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderBilling extends Model
{
    protected $table = 'order_billing';
    protected $primaryKey = 'order_billing_if';
    public $timestamps = false;

}
