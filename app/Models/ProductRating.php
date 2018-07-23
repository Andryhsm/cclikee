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

class ProductRating extends Model
{

    protected $table = 'product_rating';
    protected $primaryKey = 'product_rating_id';
    public $timestamps = false;
    const SUCCESS_MESSAGE='Product rating successfully save.';
    const ALREADY_SUBMIT_REVIEW='You have already submit the review.';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'review',
        'review_date',
        'review_date',
    ];

    public function product(){
        return $this->belongsTo('App\Product','product_id','product_id');
    }

     public function user(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }

}