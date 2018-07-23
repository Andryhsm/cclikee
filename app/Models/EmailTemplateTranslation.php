<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateTranslation extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'email_template_translation';

	protected $primaryKey = 'email_template_translation_id';


	public $timestamps = false;
	protected $guarded = [];


	public function language()
	{
		return $this->belongsTo(Language::class, 'language_id', 'language_id');
	}

}
