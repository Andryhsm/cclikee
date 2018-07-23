<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreOpeningDay extends Model
{
    protected $table = 'store_opening_day';
	/**
	 * @var string
	 */
	protected $primaryKey = 'opening_day_id';
	/**
	 * @var array
	 */
	protected $fillable = ['day_name'];
    public $timestamps = false;
}
