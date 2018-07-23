<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'blog_tag';
	/**
	 * @var string
	 */
	protected $primaryKey = 'blog_tag_id';

	public $timestamps=false;
}
