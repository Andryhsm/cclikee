<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'faqs';
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';

	public function byLanguage($language,$field)
	{
		$english_field = "english_$field";
		$french_field = "french_$field";
		if($language=='1' || ($language=='2' && empty($this->$french_field))){
			$return_data = $this->$english_field;
		} else {
			$return_data = $this->$french_field;
		}
		return $return_data;
	}

}
