<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $table = 'tag';
	/**
	 * @var string
	 */
	protected $primaryKey = 'tag_id';
	/**
	 * @var array
	 */
	protected $fillable = ['tag', 'created_by'];

}
