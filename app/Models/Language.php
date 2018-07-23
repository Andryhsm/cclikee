<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
	/**
	 * @var string
	 */
    const FRENCH_CODE='fr';
	protected $table = 'language';
	/**
	 * @var string
	 */
	protected $primaryKey = 'language_id';

	public $timestamps = false;
}
