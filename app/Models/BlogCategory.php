<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'blog_category';
	/**
	 * @var string
	 */
	protected $primaryKey = 'blog_category_id';


	public function admin()
	{
		return $this->hasOne(Admin::class, 'admin_id', 'created_by');
	}
	public function byLanguage($language,$field)
	{
		if($language=='1'){
			$return_field = "english_$field";
		} else {
			$return_field = "french_$field";
		}
		return $this->$return_field;
	}

	public function posts()
	{
		return $this->hasMany(BlogPost::class,'blog_category_id','blog_category_id');
	}

}
