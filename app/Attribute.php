<?php

namespace App;

use App\Models\Admin;
use App\Models\AttributeTranslation;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'attribute';
	/**
	 * @var string
	 */
	protected $primaryKey = 'attribute_id';
	/**
	 * @var array
	 */
	protected $fillable = ['attribute_id','type', 'is_required', 'created_by'];

	public function options()
	{
		return $this->hasMany(AttributeOption::class,'attribute_id','attribute_id')->orderby('attribute_num','asc');
	}

	public function admin()
	{
		return $this->hasOne(Admin::class,'admin_id','created_by');
	}

	public function translation($language=null)
	{
		if($language==null){
			return $this->hasMany(AttributeTranslation::class,'attribute_id');
		} else {
			return $this->hasOne(AttributeTranslation::class,'attribute_id')->where('language_id',$language);
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

	public function getByLanguageid($language_id){
		$option_translation= $this->translation->filter(function ($value, $key) use($language_id) {
			return ($value->language_id==$language_id);
		});
		return (count($option_translation)==0)?$this->translation->first():$option_translation->first();
	}

	//Relation Attribute<->Attribute_set
	public function attribute_sets()
	{
		return $this->belongsToMany(AttributeSet::class,'attribute_set_to_attribute','attribute_id','attribute_set_id');
	}

}
