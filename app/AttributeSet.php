<?php

namespace App;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
	/**
	 * @var string
	 */
	protected $table = 'attribute_set';
	/**
	 * @var string
	 */
	protected $primaryKey = 'attribute_set_id';
	/**
	 * @var array
	 */
	protected $fillable = ['set_name', 'created_by'];


	public function admin()
	{
		return $this->hasOne(Admin::class, 'admin_id', 'created_by');
	}

	public function attributes()
	{
		return $this->belongsToMany(Attribute::class,'attribute_set_to_attribute','attribute_set_id','attribute_id');
	}

}
