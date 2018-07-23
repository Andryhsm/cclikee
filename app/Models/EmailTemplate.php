<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;

use App\Url;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{

    protected $table = 'email_template';
    protected $primaryKey = 'email_template_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'template_type',
        'template_name',
        'subject',
        'content',
        'styles',
        'is_html',
        'created_by',
    ];

	public function translation($language = null)
	{
		if ($language == null) {
			return $this->hasMany(EmailTemplateTranslation::class, 'email_template_id');
		} else {
			return $this->hasOne(EmailTemplateTranslation::class, 'email_template_id')->where('language_id', $language);
		}
	}

	public function english()
	{
		return $this->translation(1);
	}

	public function french()
	{
		return $this->translation(2);
	}

}