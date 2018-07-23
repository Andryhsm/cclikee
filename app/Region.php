<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'regions';
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';

	public function country()
	{
		return $this->belongsTo(Country::class,'id');
	}
}
