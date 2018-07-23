<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'user_role';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_name',
        'note',
    ];

}