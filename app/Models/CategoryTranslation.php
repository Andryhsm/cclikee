<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'category_translation';
	/**
	 * @var string
	 */
	protected $primaryKey = 'category_translation_id';
	/**
	 * @var array
	 */
	protected $guarded = [];
	public $timestamps = false;


	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}

	public function byLanguage($language_id)
	{

	}


}
