<?php
/**
 * Created by PhpStorm.
 */
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderTransaction extends Model
{
    protected $table = 'order_transaction';
    protected $primaryKey = 'order_transaction_id';
	public $timestamps = false;

}
