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

class LinkAdjustment extends Model
{

    protected $table = 'link_adjustment';
    protected $primaryKey = 'link_adjustment_id';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'link',
        'description',
    ];

    public function user(){
        return $this->hasOne(User::class,'user_id','user_id');
    }

}