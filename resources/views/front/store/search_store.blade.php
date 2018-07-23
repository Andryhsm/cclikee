<?php
namespace App\Http\Controllers\Front;

use App\BrandTag;
use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRequest;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\RegionRepositoryInterface;
use App\Interfaces\StoreRepositoryInterface;
use App\Models\Brand;
use App\Service\UploadService;
use App\Store;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    

    public function store(StoreRequest $store_request)
    {

        $all_input = $store_request->all();
        $logo_name = "";
        if ($store_request->hasFile("logo")) {
            $file = $store_request->file("logo");
            $logo_name = $this->upload_service->upload($file, Store::LOGO_IMG_PATH);
            $all_input['logo_image'] = $logo_name;
        }
        $shop_image = "";
        if ($store_request->hasFile("shop_image")) {
            $file = $store_request->file("shop_image");
            $shop_image = $this->upload_service->upload($file, Store::SHOP_IMG_PATH);
            $all_input['shop_image'] = $shop_image;
        }
        $store = $this->store_repository->add($all_input,\Auth::user()->user_id);
        flash()->success(config('message.store.add-success'));
        return redirect()->to('merchant');
    }

       
     
      @param  int $id
      @return \Illuminate\Http\Response
            
   public function getCoordinates(Request $request)
    {
        $input = $request->all();
        $address = $input['address1'].', '.$input['address2'].', '.$input['city'].', '.$input['zip'].', '.$input['state'].', '.$input['country'];
        $prepAddr = str_replace(' ','+',$address);
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
    public function search(Request $request)
    {
        $Search=$request->zip;
        $Store= DB::table('store')->where('zip', 'like', "$Search")->get();
        return view('front.store.store-tab',compact('index','countries','store','brands','brand_tags'));
    }
}