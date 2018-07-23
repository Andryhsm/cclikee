<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProductRequest;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\LanguageInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\SpecialProductRepositoryInterface;
use App\Models\SpecialProduct;
use App\Product;
use App\Repositories\AttributeSetRepository;
use App\Repositories\SpecialProductRepository;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class SpecialProductController extends Controller
{

    protected $special_product_repository;
	public function __construct(SpecialProductRepositoryInterface $special_product_repository)
	{
        $this->special_product_repository=$special_product_repository;
	}

	public function index()
	{
        $special_products=$this->special_product_repository->getAll();
        $special_products = $special_products->groupBy('type');
        $special_product_type=['1'=>'COUP DE COEUR','2'=>'MEILLEURES VENTES','3'=>'MIEUX NOTÉS'];
        return view('admin.special_product.list',compact('special_products','special_product_type'));
	}

	public function create()
	{
		return view('admin.special_product.form');
	}

	public function store(Request $request)
	{
		$product = $this->special_product_repository->create($request->all());
		flash()->success(config('message.special-product.add-success'));
		return Redirect::to('admin/special-product');
	}

    public function show($id){

    }

	public function edit($type_id)
	{
        $special_product =SpecialProduct::with('product','productTranslation')->where('type',$type_id)->get();
     	return view('admin.special_product.edit', compact('special_product'));
	}

	public function update($id, Request $request)
	{
		$product = $this->special_product_repository->updateById($id, $request->all());
		flash()->success(config('message.special-product.update-success'));
		return Redirect::to('admin/special-product');
	}


	public function destroy($type)
	{
		
		if ($this->special_product_repository->deleteSpecialProduct($type)) {
			flash()->success(config('message.special-product.delete-success'));
		} else {
			flash()->error(config('message.special-product.delete-error'));
		}
		return Redirect::to('admin/special-product');
	}

    public function getProduct(Request $request){
        $keyword = $request->get('datastring');
        $products = $this->special_product_repository->getProducts($keyword);
        return response()->json($products);
    }
}
