<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateVariable extends Model
{
	protected $table = 'email_template_variables';
	public $timestamps = false;

	public function emailTemplate()
	{
		return $this->belongsTo(EmailTemplate::class,'email_template_id','email_template_id');
	}
}
