<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeTranslation extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'attribute_translation';

	protected $primaryKey = 'attribute_translation_id';


	public $timestamps = false;
	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class,'language_id','language_id');
	}
}
