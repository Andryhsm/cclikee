<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 4/22/2017
 * Time: 9:19 AM
 */

namespace App\Models;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ProductVideo extends Model
{

    protected $table = 'product_video';
    protected $primaryKey = 'product_video_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
}