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

class Page extends Model
{

    protected $table = 'page';
    protected $primaryKey = 'page_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_title',
        'status',
        'content_heading',
        'content',

    ];

    public function url()
    {
        return $this->hasOne(Url::class, 'target_id')->whereType(3);
    }
	public function translation($language=null)
	{
		if($language==null){
			return $this->hasMany(PageTranslation::class,'page_id');
		} else {
			return $this->hasOne(PageTranslation::class,'page_id')->where('language_id',$language);
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