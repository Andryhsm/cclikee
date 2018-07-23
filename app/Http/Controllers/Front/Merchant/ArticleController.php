<?php

namespace App\Http\Controllers\Front\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\AttributeSetRepository;
use Yajra\Datatables\Facades\Datatables;
use App\Service\UploadService;
use App\Product;

class ArticleController extends Controller
{
    
    protected $category_repository;
    protected $upload_service;
    protected $attribute_set_repository;
    protected $product_repository;
    
    public function __construct(ProductRepositoryInterface $product_repo, CategoryRepositoryInterface $category_repo,UploadService $uploadservice, AttributeSetRepository $attribute_set_repo)
    {
        $this->category_repository = $category_repo;
        $this->product_repository = $product_repo;
        $this->upload_service = $uploadservice;
        $this->attribute_set_repository = $attribute_set_repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store_id = auth()->user()->store->first()->store_id;
        $products = Datatables::collection($this->product_repository->getByStore($store_id))->make(true);
		$products = $products->getData();
        return view('merchant.article.list',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = false;
        $categories = $this->category_repository->getParentCategories(2);
        $attribute_sets = $this->attribute_set_repository->getAll();
        return view('merchant.article.form',compact('product','categories','attribute_sets'));
    }
    
    public function getChild(Request $request)
    {
        $id = $request->get('category_id');
        $childs = $this->category_repository->getChildCategory($id);
        $category_childs = [];
        foreach($childs as $child)
        {
            $category_childs[] = $child->category_id."$".$child->getByLanguage(2)->category_name;
        }
        return response()->json($category_childs);
    }
   
    public function store(Request $request)
    {
        //sans limite upload
        $product_images = [];
        $images = $request->file('images');
        foreach ($images as $index=>$image) 
        {
            $product_images[] = $this->uploadImage($image);
        }
        $product = $this->product_repository->saveArticle($request->all(),$product_images);
		$product->load('url');
		flash()->success(config('message.product.add-success'));
		return redirect()->route('article.index');
    }
    
    public function attributes(Request $request)
	{
		$attribute_set_id = $request->get('attribute_set_id');
		$attribute_set = $this->product_repository->getAttributesBySetId($attribute_set_id);
		
		return view('merchant.article.attributes',compact('attribute_set'));
	}

    public function uploadImage($file)
	{	
		$image_name = "";
            $image_name = $this->upload_service->upload($file, Product::PRODUCT_IMAGE_PATH,false);
			$img = \Image::make(public_path().'/'.Product::PRODUCT_IMAGE_PATH.$image_name);
    		$image_name = str_replace(' ', '_', $image_name) ;						
    		$image_name = strval(mt_rand());											//genêre un nom aléatoire pour renommer l'image
    		$image_name .= ".png";
    		$img->heighten(675)->save(Product::PRODUCT_IMAGE_PATH.$image_name);
    		$thumb_path = public_path(Product::PRODUCT_IMAGE_PATH.'thumb');
			
			if(!\File::isDirectory($thumb_path)){
				\File::makeDirectory($thumb_path);
			}

			$img->fit(130,145)->save($thumb_path.'/'.$image_name);

		
		return $image_name;
	}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product_repository->getById($id);
        
        $category_id = $product->categories->first()->category_id;
        $attribute_set = $this->product_repository->getAttributesBySetId($product->attribute_set_id);
        
        $categories = $this->category_repository->getParentCategories(2);
        $attribute_sets = $this->attribute_set_repository->getAll();
        $category_childs = $this->category_repository->getChildCategory($category_id);
        
        return view('merchant.article.form',compact('product','categories','attribute_sets','category_childs','attribute_set'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_images = [];
        if($request->file('images'))
        {
            $images = $request->file('images');
            foreach ($images as $index=>$image) 
            {
                $product_images[] = $this->uploadImage($image);
            }
        }
        $product = $this->product_repository->updateArticle($request->all(),$product_images);
		$product->load('url');
		flash()->success(config('message.product.update-success'));
		return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->product_repository->deleteById($id)) {
			flash()->success(config('message.product.delete-success'));
		} else {
			flash()->error(config('message.product.delete-error'));
		}
		return redirect()->route('article.index');
    }
}
