<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{

    protected $table = 'role_permission';
    //protected $primaryKey = 'permission_id';
     public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public function permission(){
        return $this->hasMany(Permission::class,'permission_id');
    }

}