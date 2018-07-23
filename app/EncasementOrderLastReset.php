<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncasementOrderLastReset extends Model
{
    protected $table = 'encasement_order_last_reset';
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';
	
	protected $fillable = ['total_price', 'store_id'];
}
