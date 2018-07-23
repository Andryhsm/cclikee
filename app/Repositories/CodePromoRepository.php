<?php

namespace App\Repositories;

use App\Interfaces\CodePromoRepositoryInterface;
use App\Models\CodePromo;
use App\Models\ProductTranslation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CodePromoRepository implements CodePromoRepositoryInterface
{
    protected $model;

    public function __construct(CodePromo $code_promo)
    {
        $this->model = $code_promo;
    }
    public function save($input){
        $this->model->user_id = auth()->user()->store->first()->store_id;
        $this->model->code_promo_name = $input['code_promo_name'];
        $this->model->date_debut = Carbon::parse($input['date_debut']);
        $this->model->date_fin = Carbon::parse($input['date_fin']);
        $this->model->quantity_max = $input['quantity_max'];
        $this->model->save();
        if (isset($input['categories'])) {
            foreach ($input['categories'] as $category) {
                $this->model->categories()->attach($category);
            }
        }
        if(!empty($input['product'])){
            $products = explode(',', $input['product']);
            foreach($products as $product_id){
                $this->model->products()->attach($product_id);
            }
        }
        return $this->model;
    }

    public function getAll($user_id){
        return $this->model->with('categories','categories.french','products','products.french')->where('user_id',$user_id)->orderBy('code_promo_id', 'desc')->get();
    }

    public function updateById($code_promo_id, $input){
        $code_promo = $this->model->findOrNew($code_promo_id);
        $code_promo->code_promo_name = $input['code_promo_name'];
        $code_promo->date_debut = Carbon::parse($input['date_debut']);
        $code_promo->date_fin = Carbon::parse($input['date_fin']);
        $code_promo->quantity_max = $input['quantity_max'];
        $code_promo->save();
        $code_promo->categories()->detach();
        if (isset($input['categories'])) {
            foreach ($input['categories'] as $category) {
                $code_promo->categories()->attach($category);
            }
        }
        $code_promo->products()->detach();
        if(!empty($input['product'])){
            $products = explode(',', $input['product']);
            foreach($products as $product_id){
                $code_promo->products()->attach($product_id);
            }
        }
        return $code_promo;
    }

    public function deleteById($code_promo_id){
        return $this->model->where('code_promo_id', $code_promo_id)->delete();
    }

    public function getById($code_promo_id){
        return $this->model->where('code_promo_id', $code_promo_id)->first();
    }

    public function getByUserCategory($category_id, $user_id){
        /*$result = CodePromo::where('category_id', $category_id)->get();
        \Log::debug($result);*/
    }
    public function getProducts($keyword,$user_id)
    {
        return ProductTranslation::where('product_name', 'like', "%$keyword%")->where('user_id',$user_id)->where('language_id',2)->groupBy('product_id')->get();
    }
}