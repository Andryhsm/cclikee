<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreOpeningHour extends Model
{
    protected $table = 'store_opening_hour';
	/**
	 * @var string
	 */
	protected $primaryKey = 'opening_hour_id';
	/**
	 * @var array
	 */
	protected $fillable = ['opening_hour', 'closure_hour', 'opening_day_id', 'store_id'];
    public $timestamps = false;
    
    public function day()
	{
		return $this->hasOne(\App\StoreOpeningDay::class,'opening_day_id','opening_day_id');
	}
}
