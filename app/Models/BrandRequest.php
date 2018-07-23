<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BrandRequest extends Model
{

    protected $table = 'request_brand';
    protected $primaryKey = 'request_brand_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_id',
    ];

}