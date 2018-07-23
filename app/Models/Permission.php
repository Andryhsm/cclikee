<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{

    protected $table = 'permission';
    protected $primaryKey = 'permission_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module_name',
        'parent_id'
    ];

}