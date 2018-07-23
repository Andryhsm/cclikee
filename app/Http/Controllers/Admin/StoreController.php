<?php

namespace App\Http\Controllers\Admin;

use App\BrandTag;
use App\Http\Requests\Admin\StoreRequest;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\RegionRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Models\Brand;
use App\Service\UploadService;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Facades\Datatables;

class StoreController extends Controller
{
	protected $region_repository;
	protected $store_repository;
	protected $upload_service;
	protected $brand_repository;

	public function __construct(StoreRepositoryInterface $store_repo, RegionRepositoryInterface $region_repo, UploadService $uploadService, BrandRepositoryInterface $brand_repo)
	{
		$this->store_repository = $store_repo;
		$this->region_repository = $region_repo;
		$this->upload_service = $uploadService;
		$this->brand_repository = $brand_repo;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$stores = Datatables::collection($this->store_repository->getAll())->make(true);
		$stores = $stores->getData();
		
		return view('admin.store.list', compact('stores'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$countries = $this->region_repository->getCountries();
		$store = false;
		$brands = $this->brand_repository->lists();
		$brand_tags = BrandTag::get();
		return view('admin.store.form', compact('countries','store','brands','brand_tags'));
	}

	public function store(StoreRequest $store_request)
	{

		$all_input = $store_request->all();
		if($store_request->has('store')){
			foreach ($store_request->get('store') as $index=>$store)
			{
				$logo_name = "";
				if ($store_request->hasFile("store.$index.logo")) {
					$file = $store_request->file("store.$index.logo");
					$logo_name = $this->upload_service->upload($file, Store::LOGO_IMG_PATH);
					$all_input['store'][$index]['logo_image'] = $logo_name;
				}
				$shop_image = "";
				if ($store_request->hasFile("store.$index.shop_image")) {
					$file = $store_request->file("store.$index.shop_image");
					$shop_image = $this->upload_service->upload($file, Store::SHOP_IMG_PATH);
					$all_input['store'][$index]['shop_image'] = $shop_image;
				}
			}
		}
		$store = $this->store_repository->save($all_input);
		flash()->success(config('message.store.add-success'));
		return redirect()->to('admin/store');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$store = $this->store_repository->getById($id);
		$countries = $this->region_repository->getCountries();
		$brands = $this->brand_repository->lists();
		$brand_tags = BrandTag::get();
		return view('admin.store.form', compact('countries','store','brands','brand_tags'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update($id,StoreRequest $store_request)
	{
		$all_input = $store_request->all();
		if($store_request->has('store')){
			foreach ($store_request->get('store') as $index=>$store)
			{
				$logo_name = "";
				if ($store_request->hasFile("store.$index.logo")) {
					$file = $store_request->file("store.$index.logo");
					$logo_name = $this->upload_service->upload($file, Store::LOGO_IMG_PATH);
					$all_input['store'][$index]['logo_image'] = $logo_name;
				}
				$shop_image = "";
				if ($store_request->hasFile("store.$index.shop_image")) {
					$file = $store_request->file("store.$index.shop_image");
					$shop_image = $this->upload_service->upload($file, Store::SHOP_IMG_PATH);
					$all_input['store'][$index]['shop_image'] = $shop_image;
				}
			}
		}
		$store = $this->store_repository->updateById($id, $all_input);
		flash()->success(config('message.store.update-success'));
		return redirect()->to('admin/store');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		if ($this->store_repository->deleteById($id)) {
			flash()->success(config('message.store.delete-success'));
		} else {
			flash()->error(config('message.store.delete-error'));
		}
		return redirect()->to('admin/store');
	}

	public function getCoordinates(Request $request)
	{
		$input = $request->all();
		$address = $input['address1'].', '.$input['address2'].', '.$input['city'].', '.$input['zip'].', '.$input['state'].', '.$input['country'];
//		$address = 'Cafe Coffee Day, INSIDE HPCL Petrol Bunk, Mumbai - Goa Highway,Mangaon, Maharashtra, India';
		$prepAddr = str_replace(' ','+',$address);
//		echo $prepAddr;exit;
		$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
		$output= json_decode($geocode);

		if(empty($output->results)){
			return response()->json(['status'=>false,'msg'=>'Address not found']);
		} else {
			$lat = $output->results[0]->geometry->location->lat;
			$long = $output->results[0]->geometry->location->lng;
			return response()->json(['status'=>true,'latitude'=>$lat,'longitude'=>$long]);
		}
	}

	public function getHtml($index)
	{
		$countries = $this->region_repository->getCountries();
		$store = false;
		$brands = Brand::with('parent')->active()->get();
		$brand_tags = BrandTag::get();
		return view('admin.store.store-tab',compact('index','countries','store','brands','brand_tags'));
	}
}
