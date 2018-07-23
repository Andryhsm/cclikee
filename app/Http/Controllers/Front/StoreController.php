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
use Illuminate\Support\Facades\Redirect;
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

    public function create()
    {
        $countries = $this->region_repository->getCountries();
        $store = false;
        $brands = $this->brand_repository->lists();
        $brand_tags = BrandTag::get();
        return view('front.merchant.register', compact('countries', 'store', 'brands', 'brand_tags'));
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

    public function postRegister(Request $request)
	{
		$rules = array(
			'shop_name' => 'required',
			'registration_number' => 'required',
			'address1' => 'required',
			'city' => 'required',
			'zip_code' => 'required',
			'country_id' => 'required',
			'state_id' => 'required',
			'latitude' => 'required',
			'longitude' => 'required',
			'main_phone' => 'required',
			'main_email' => 'required',
			'cell_phone' => 'required',
			'fix_phone' => 'required',
			//'g-recaptcha-response'=>'required|recaptcha'
/*			'last_name' => 'required',
			'first_name' => 'required',
			'position' => 'required',
			'sms' => 'required',
			'email' => ['required',
				Rule::unique('users')->where(function ($query) {
					$query->where('role_id', 2);
				})
			],
			'password' => 'required'*/
		);
		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return \Redirect::back()->withInput()->withErrors($validator);
		} else {
			try{
				$all_input = $request->all();
				$logo_name = "";
				if ($request->hasFile("logo")) {
					$file = $request->file("logo");
					$logo_name = $this->upload_service->upload($file, Store::LOGO_IMG_PATH);
					$all_input['logo_image'] = $logo_name;
				}
				$shop_image = "";
				if ($request->hasFile("shop_image")) {
					$file = $request->file("shop_image");
					$shop_image = $this->upload_service->upload($file, Store::SHOP_IMG_PATH);
					$all_input['shop_image'] = $shop_image;
				}

				$users = $this->store_repository->add($all_input);

				$stripe = Stripe::make(config('services.stripe.secret'));
				foreach ($users as $user){
					$stripe_user = $stripe->customers()->create([
						'email' => $user->email,
					]);
					$user->stripe_id = $stripe_user['id'];
					$user->save();
				} 

				\Event::fire(new UserRegistered($user));
				Auth::login($user);
				flash()->success(trans('form.register_success_message'));
			}catch (\Exception $e){
				flash()->error(trans('form.register_error_message'));
				return \Redirect::back()->withInput()->withErrors($validator);
			}
		}

		return redirect()->route('merchant-dashboard');
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
        return view('merchant.register_edit', compact('countries','store','brands','brand_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $store_request)
    {
		$rules = array(
			'shop_name' => 'required',
			'registration_number' => 'required',
			'address1' => 'required',
			'city' => 'required',
			'zip_code' => 'required',
			'country_id' => 'required',
			'state_id' => 'required',
			'latitude' => 'required',
			'longitude' => 'required',
			'main_phone' => 'required',
			'main_email' => 'required',
			'cell_phone' => 'required',
			'fix_phone' => 'required',
			'g-recaptcha-response'=>'required|recaptcha'
/*			'last_name' => 'required',
			'first_name' => 'required',
			'position' => 'required',
			'sms' => 'required',
			'email' => ['required',
				Rule::unique('users')->ignore($store_request->get('user_id'), 'user_id')->where(function ($query) {
					$query->where('role_id', 2);
				})
			],
			'password' => 'required'*/
		);
		$validator = \Validator::make($store_request->all(), $rules);
		if ($validator->fails()) {
			return \Redirect::back()->withInput()->withErrors($validator);
		} else {
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
			$store = $this->store_repository->update($id, $all_input);
			flash()->success(config('message.store.update-success'));
		}
		return redirect()->route('magasin.edit',['store' => $store->store_id]);
	}

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
}