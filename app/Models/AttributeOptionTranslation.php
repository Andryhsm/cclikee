<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeOptionTranslation extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'attribute_option_translation';
	protected $primaryKey = 'attribute_option_translation_id';

	public $timestamps = false;

	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}
}
