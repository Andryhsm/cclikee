<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Url;
class BlogPost extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'blog_post';
	/**
	 * @var string
	 */
	protected $primaryKey = 'blog_post_id';
	const PAGE_LIMIT = 5;
	const IMAGE_PATH = 'upload/blog';
	const IMAGE_PATH_C = 'upload/blog/';
	const IMAGE_PATH_THUMB = 'upload/blog/thumb';

	const IMAGE_CDN_PATH_THUMB = 'https://db-alternateeve-csi7douue.stackpathdns.com/upload/blog/thumb';
	const IMAGE_CDN_PATH = 'https://db-alternateeve-csi7douue.stackpathdns.com/upload/blog';

	public function category()
	{
		return $this->hasOne(BlogCategory::class, 'blog_category_id', 'blog_category_id');
	}

	public function admin()
	{
		return $this->hasOne(Admin::class, 'admin_id', 'created_by');
	}

	public function tags(){
		return $this->belongsToMany(BlogTag::class,'blog_post_to_tag','blog_post_id','blog_tag_id');
	}

	public function getImage()
	{
		return url(self::IMAGE_PATH .'/'. $this->banner_image);
	}

	public function getCdnImage()
	{
		return url(self::IMAGE_CDN_PATH .'/'. $this->banner_image);
	}

	public function getImagethumb()
	{
		return url(self::IMAGE_PATH_THUMB.'/'.$this->banner_image);
	}

	public function getCdnImagethumb()
	{
		return url(self::IMAGE_CDN_PATH_THUMB.'/'.$this->banner_image);
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
	public function url()
	{
		return $this->hasOne(Url::class, 'target_id')->whereType(4);
	}

	public function relatedPosts()
	{
		return $this->belongsToMany(BlogPost::class,'related_post','blog_post_id','related_post_id');
	}

	public function getPostNameByLanguage($language_code){
		return ($language_code=='en' || $this->french_title=='')?$this->english_title:$this->french_title;
	}


}
