<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\StoreRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cookie;

class AutocompleteController extends Controller
{
    //
    protected $product_repository;

    public function __construct(ProductRepositoryInterface $product_interface, StoreRepositoryInterface $store_repo)
    {
    	$this->product_repository = $product_interface;
        $this->store_repository = $store_repo;
    }
    
    public function getAllProductInArea(Request $request)
    {
        $language_id=app('language')->language_id;
        $all_products = [];                      
        $store_ids = [];
        
        
        if(Cookie::has('zip-code') && Cookie::has('radius')){
            $zip_code = Cookie::get('zip-code');
            $zip_code = str_replace(' ', '+', $zip_code);
            $zip_code = str_replace('%', '+', $zip_code);
            $requested_distance = intval(Cookie::get('radius'));
            $responses = [];
            $stores = $this->store_repository->getAll();
            foreach ($stores as $store) {
                 try{
                    $distance = getDistanceStore($store->latitude, $store->longitude, $zip_code, $store->country->name);
                    
                    if($distance < $requested_distance){
                        $store_ids[] = $store->store_id;
                    }
                }catch (\Exception $e){
                    
                }
                
            }
            if(!empty($store_ids)){
                $all_products = $this->product_repository->getProductByCategory(Input::all(), $store_ids);
            }else{
                $all_products = $this->product_repository->getProductByCategory(Input::all(), $store_ids);
            }
        }else{
            $all_products = $this->product_repository->getProductByCategory(Input::all(), []);
        }
        
        return response()->json(['products' => $all_products]);
    }
}
