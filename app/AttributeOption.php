<?php

namespace App;

use App\Models\AttributeOptionTranslation;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'attribute_option';
	/**
	 * @var string
	 */
	protected $primaryKey = 'attribute_option_id';
	/**
	 * @var array
	 */
	protected $fillable = ['attribute_num'];

	public $timestamps = false;
    const COLOR = 1;
    const SIZE = 2;

	public function translation($language=null)
	{
		if($language==null) {
			return $this->hasMany(AttributeOptionTranslation::class, 'attribute_option_id');
		} else {
			return $this->hasOne(AttributeOptionTranslation::class, 'attribute_option_id')->where('language_id',$language);
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

	public function swatch()
	{
		if ($this->color_code == null) {
			return '';
		} else {
			$color_code = str_replace('#','',$this->color_code);
			return \URL::to('image-color-code', ['color_code' => $color_code]);
		}
	}
}
