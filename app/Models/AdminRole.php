<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{

    protected $table = 'admin_role';
    protected $primaryKey = 'admin_role_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name',
    ];

    public function permissions(){
       return $this->belongsToMany(Permission::class,'role_permission','role_id','permission_id');
    }
}