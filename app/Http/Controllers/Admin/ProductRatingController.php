<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use App\Repositories\ProductRatingRepository;
use App\Repositories\AdminUserRepository;
use App\Repositories\UserRepository;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Facades\Datatables;
use Validator;
use Session;
use Redirect;

class ProductRatingController extends Controller
{
    protected $product_rating_repository;

    public function __construct(ProductRatingRepository $product_rating_repository)
    {
        $this->product_rating_repository = $product_rating_repository;
        
    }

    public function index(Request $request)
    {
        $ratings = Datatables::collection($this->product_rating_repository->getAll())->make(true);
        $ratings = $ratings->getData();
        return view('admin.rating.list')->with('ratings', $ratings);
    }

    public function show($id)
    {
         $rating = $this->product_rating_repository->getById($id);
        return view('admin.rating.view', compact('user'));
    }

    public function update($id, Request $request)
    {
      
        $rules = array(
            'rating' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
                $rating = $this->product_rating_repository->updateById($id, $request->all());
                flash()->success(config('message.rating.update-success'));
                return Redirect::to('admin/product-rating');
           
        }
    }

    public function edit($id, Request $request)
    {
        $rating = $this->product_rating_repository->getById($id);
        return view('admin.rating.edit',compact('rating'));
    }

    public function destroy($id, Request $request)
    {

        if ($this->product_rating_repository->deleteById($id)) {
            flash()->success(config('message.rating.delete-success'));
            return Redirect('admin/product-rating');
        }

    }
}
