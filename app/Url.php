<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
	protected $table = 'sys_url_rewrite';
	protected $primaryKey = 'sys_url_rewrite_id';
	public $timestamps = false;

}
