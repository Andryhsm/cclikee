<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EpartnerMedia extends Model
{
	protected $table = 'epartner_media';
	protected $primaryKey = 'id';
	const IMAGE_PATH = '/upload/epartner/';
	public $timestamps = false;

}
