<?php

namespace App\Http\Controllers\Admin;

use App\BrandTag;
use App\Models\BrandCategory;
use App\Repositories\BrandRepository;
use App\Models\Brand;
use App\Models\BrandRequest;
use App\RequestBrand;
use App\Service\UploadService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
	protected $upload_service;
	protected $brand_repository_interface;

	public function __construct(UploadService $upload_service,BrandRepository $brand_repository)
	{
		$this->upload_service = $upload_service;
		$this->brand_repository = $brand_repository;
	}

	public function index()
	{
		return view('admin.brand.index',compact('brand_requests'));
	}

	public function getData()
	{
		$data_tables = \Datatables::collection($this->brand_repository->get());

		$data_tables->EditColumn('brand_name', function ($brand) {
			return  (!is_null($brand->parent_id)) ? $brand->parent->brand_name." ".$brand->brand_name : $brand->brand_name;
		})->EditColumn('website', function ($brand) {
			return $brand->website;
		})->EditColumn('created_at', function ($brand) {
			return convertDate($brand->created_at);
		})->EditColumn('created_by', function ($brand) {
			return ($brand->admin)?$brand->admin->first_name." ".$brand->admin->last_name:"";
		})->EditColumn('action', function ($brand) {
			return view("admin.brand.partial", ['brand' => $brand]);
		});
		return $data_tables->make(true);

	}

	public function create()
	{
        $brands = Brand::all();
        $brand_requests=BrandRequest::all();
		$brand_tags = BrandTag::all();
		return view('admin.brand.create',compact('brands','brand_requests','brand_tags'));
	}
 
	public function store(Request $request)
	{
		$rules = array(
			'brand_name' => 'required',
			'image' => 'mimes:jpeg,jpg,png,gif|max:10000' // max 10000kb
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::to('admin/brand/create')->withInput()->withErrors($validator);
		} else {
			$image_name=$this->uploadImage();
			$brand=$this->brand_repository->create($request->all(),$image_name);
			if($brand){
				flash()->success(config('message.brand.add-success'));
				return Redirect('admin/brand');
			}
		}
	}

	public function edit($id, Request $request)
	{
		$brand = Brand::with('children','tags','children.tags')->find($id);
		$all_tags = BrandTag::all();
		return view('admin.brand.edit',compact('brand','all_tags'));
	}

	public function update($id,Request $request){

		$rules = array(
			'name' => 'required',
			'image' => 'mimes:jpeg,jpg,png,gif|max:10000' // max 10000kb
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		} else {

			$image_name=$this->uploadImage();
			$brand=$this->brand_repository->update($id,$request->all(),$image_name);
			if($brand){
				flash()->success(config('message.brand.update-success'));
				return Redirect('admin/brand');
			}
			return Redirect('admin/brand');
		}
	}

	public function uploadImage(){
		$image_name = "";
		if (Input::File('image')) {
			$file = Input::file('image');
			$image_name = $this->upload_service->upload($file, 'upload/brand');
		}
		return $image_name;
	}
	public function destroy($id)
	{
		$brand = Brand::find($id);
		if(!empty($brand) && count($brand->children)>0){
			$brand->children()->delete();
		}
		if(!empty($brand)){
			$brand->delete();
			flash()->success(config('message.brand.delete-success'));
		}
		return Redirect('admin/brand');
	}

	public function getAllBrands()
	{
		$brands = Brand::with('parent')->active()->get();
		$return = [];
		foreach ($brands as $brand){
			$return[$brand->brand_id]['brand_name'] = ($brand->parent_id==null) ? $brand->brand_name : $brand->parent->brand_name." ".$brand->brand_name;
			$return[$brand->brand_id]['brand_id'] = $brand->brand_id;
		}
		return response()->json($return);
	}

	public function byTag(Request $request)
	{
		$tags_id = $request->get('tags');
		if(empty($tags_id)){
			$brands = $this->brand_repository->lists();
			return response()->json($brands);
		}
		$tags_id = explode(',',$tags_id);
		$tags = BrandTag::with(['brands'=>function ($query) {
									$query->active();
							},'brands.parent'])
			->whereIn('brand_tag_id',$tags_id)->get();
		$brands = [];
		if(!empty($tags)){
			foreach ($tags as $tag){
				if(!empty($tag->brands)){
					foreach ($tag->brands as $brand)
					{
						$brands[$brand->brand_id] = $brand;
					}
				}
			}
		}
		$brand_collection = collect($brands);
		$sorted = $brand_collection->sortBy(function ($brand, $key) {
			return (($brand->parent_id==null) ? $brand->brand_name : $brand->parent->brand_name." ".$brand->brand_name);
		});

		return response()->json($sorted->values()->all());
	}

	public function removeRequestBrand($brand_id)
	{
		return RequestBrand::destroy($brand_id);
	}
}
