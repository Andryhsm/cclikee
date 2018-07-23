<?php

namespace App\Repositories;

use App\Interfaces\ProductRatingRepositoryInterface;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProductRatingRepository implements ProductRatingRepositoryInterface
{
    protected $model;
    protected $product_rating;

   public function __construct(ProductRating $product_rating)
    {
        $this->model = $product_rating;
    }

    public function getAll()
    {
        return ProductRating::with('product','product.english','user')->get();
    }

    public function getById($id){
        return ProductRating::find($id);
    }

     public function updateById($id, $input)
    {
        $product_rating = $this->model->findOrNew($id);
        $product_rating->title = null;
        $product_rating->review = $input['review'];
        $product_rating->rating = $input['rating'];
        $product_rating->status = isset($input['is_active']) ? $input['is_active'] : '0';
        return $product_rating->save();
    }

    public function save($input)
    {

        //helpful count and flagged count is null necessary
        $this->model->product_id=$input['rating_product_id'];
        $this->model->user_id =  Auth::id();
        $this->model->nickname =  $input['user_name'];
        $this->model->review = $input['comment'];
        $this->model->rating =  $input['rating'];;
        $this->model->status =  '0';
        $this->model->save();
        return ["success" => false, "message" => 'Your review has been added  successfully'];

    }

    public function getReviewById($input){
        return $this->model->where('product_id',$input['product_id'])->where('user_id',Auth::id())->count();
    }

    public function getApprovedReview($product_id)
    {
        return $this->model->where('product_id',$product_id)->where('status', 1)->orderBy('review_date','desc')->paginate(4);
    }

    public function getApprovedRating($product_id)
    {
        return $this->model->where('product_id',$product_id)->where('status', 1)->sum('rating');
    }

    public function getApprovedAllReview($product_id)
    {
        return $this->model->where('product_id',$product_id)->where('status', 1)->get();
    }

    public function deleteById($id)
    {
        return $this->model->find($id)->delete();
    }
}