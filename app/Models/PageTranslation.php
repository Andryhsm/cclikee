<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageTranslation extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'page_translation';

	protected $primaryKey = 'page_translation_id';


	public $timestamps = false;
	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class, 'language_id', 'language_id');
	}

}
