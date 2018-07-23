<?php

namespace App\Repositories;

use App\Interfaces\SpecialProductRepositoryInterface;
use App\Models\ProductTranslation;
use App\Models\SpecialProduct;
use App\Product;
use App\UserAddress;
use Illuminate\Support\Facades\Hash;

class SpecialProductRepository implements SpecialProductRepositoryInterface
{
    protected $model;

    public function __construct(SpecialProduct $special_product)
    {
        $this->model = $special_product;
    }

    public function getAll(){
        return SpecialProduct::all();
    }

    public function create($input)
    {

        if(!empty($input['product'])){
            $products = explode(',', $input['product']);
            foreach($products as $product_id){
                $this->model=New SpecialProduct();
                $this->model->type = $input['type'];
                $this->model->product_id = $product_id;
                $this->model->save();
            }
        }
        return $this->model;
    }

    public function updateById($id, $input)
    {

        $this->deleteSpecialProduct($id);
        if(!empty($input['product'])){
            $products = explode(',', $input['product']);

            foreach($products as $product_id){
                $special_product = $this->model->findOrNew($id);
                $special_product->type = $input['type'];
                $special_product->product_id = $product_id;
                $special_product->save();
            }
        }
        return $this->model;
    }

    public function deleteSpecialProduct($id){
        return SpecialProduct::where('type',$id)->delete();
    }

    public function deleteById($id)
    {

        return $this->model->find($id)->delete();
    }

    public function getProducts($keyword)
    {
        return ProductTranslation::where('product_name', 'like', "%$keyword%")->groupBy('product_id')->get();
    }

    public function getspecialProducts(){
        $heart_stroke_products = $this->getSpecialProduct(1);
        $best_sale_products = $this->getSpecialProduct(2);
        $best_rated_sale = $this->getSpecialProduct(3);
        return ['heart_stroke'=>$heart_stroke_products,'best_sale'=>$best_sale_products,'best_rated'=>$best_rated_sale];
    }

    public function getSpecialProduct($type)
    {
        $product_ids = $this->model->where('type', $type)->pluck('product_id')->toArray();
        if (!empty($product_ids)) {
            return Product::with(['translation', 'brand','images','url'])->where('is_active', 1)->whereIn('product_id', $product_ids)->take(4)->get();
        }
        return [];
    }

}