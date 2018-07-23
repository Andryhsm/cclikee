<?php

namespace App\Repositories;


use App\Interfaces\StoreRepositoryInterface;
use App\RequestBrand;
use App\Service\UploadService;
use App\Store;
use App\User;
use App\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreRepository implements StoreRepositoryInterface
{
	protected $model;

	public function __construct(Store $store)
	{
		$this->model = $store;
	}

	public function getAll()
	{
		return $this->model->with('requests','requests.orderitem','encasements','encasementorderlastreset')->orderBy('store_id', 'desc')->get();
	}

	public function save($input,$save_from=true)
	{
		$managers = [];
		$first_store_id = 0;
		//save store manager data
		if(isset($input['manager']) && !empty($input['manager'])){
			foreach ($input['manager'] as $manager){
				$user = new User();
				$user->role_id = '2';
				$user->first_name = $manager['first_name'];
				$user->last_name = $manager['last_name'];
				$user->email = $manager['email'];
				$user->password = Hash::make($manager['password']);
				$user->phone_number = $manager['sms'];
				$user->status = '1';
				$user->profile_image = '';
				/*$user->position = $manager['position'];*/
				$user->save();


				//save in store_user
				$store_user = [
					'is_global_manager'=> isset($manager['global_manager'])? $manager['global_manager'] : 0,
					'compte_principal'=> isset($manager['compte_principle'])? $manager['compte_principle'] : 0,
					'receive_request'=> isset($manager['receive_request'])? $manager['receive_request'] : 0,
					'reply_request'=> isset($manager['reply_request'])? $manager['reply_request'] : 0,
				];
				$managers[$user->user_id] = $store_user;
			}
		}

		if(!$save_from){
			//save in store_user
			$store_user = [
				'is_global_manager'=> 0,
				'compte_principal'=>0,
				'receive_request'=>0,
				'reply_request'=>0,
			];
			$managers[\Auth::id()] = $store_user;
		}
		if(!empty($input['store'])){
			//save store data
			foreach ($input['store'] as $index=>$store){
				$store_model = new Store();
				$store_model->store_name = $store['shop_name'];
				$store_model->registration_number = $store['registration_number'];
				$store_model->phone = $store['main_phone'];
				$store_model->email = $store['main_email'];
				$store_model->logo = (!empty($store['logo_image']))?$store['logo_image']:'';
				$store_model->shop_image = (!empty($store['shop_image'])) ? $store['shop_image'] :'';
				$store_model->short_description = $store['short_description'];
				$store_model->address1 = $store['address1'];
				$store_model->address2 = $store['address2'];
				$store_model->city = $store['city'];
				$store_model->zip = $store['zip'];
				$store_model->country_id = $store['country_id'];
				$store_model->state_id = $store['state_id'];
				$store_model->latitude = $store['latitude'];
				$store_model->longitude = $store['longitude'];
				$store_model->created_by = auth()->guard('admin')->user()->admin_id;
				$store_model->save();
				$first_store_id = ($index==0)?$store_model->store_id :$first_store_id;
				foreach ($managers as $manager_id=>$manager){
					$store_model->users()->attach($manager_id,$manager);
				}

				//save all store brand
				if(isset($store['brand_list']) && !empty($store['brand_list'])){
					foreach ($store['brand_list'] as $brand_id)
					{
						$store_model->brands()->attach($brand_id);
					}
				}

			}
		}
		// save request brand data
		if(!empty($input['brand_name'])){
			$this->saveBrand($input,$first_store_id);
		}
		return $this->model;
	}

	public function saveBrand($input,$first_store_id){
		$request_brand = new RequestBrand();
		$request_brand->brand_name = $input['brand_name'];
		$request_brand->website = $input['website'];
		$request_brand->store_id =$first_store_id;
		$request_brand->save();
	}

	public function getById($store_id)
	{
		return $this->model->with('users','requestBrand','brands','hours','hours.day')->where('store_id',$store_id)->first();
	}

	public function updateById($store_id, $input)
	{
		//save store manager data
		$first_store_id = 0;
		$managers = [];
		$new_manager_id = [];
		$old_manager_id = isset($input['old_manager_id']) ? explode(',',$input['old_manager_id']) : [];
		if(isset($input['manager']) && !empty($input['manager'])){
			foreach ($input['manager'] as $manager){
				if(isset($manager['manager_id']))
				{
					$new_manager_id[] = $manager['manager_id'];
				}

				$user = User::findOrNew(isset($manager['manager_id']) ? $manager['manager_id'] : 0);
				$user->role_id = '2';
				$user->first_name = $manager['first_name'];
				$user->last_name = $manager['last_name'];
				$user->email = $manager['email'];
				$user->password = (!empty($manager['password']) && $manager['password'] != null) ?  Hash::make($manager['password']) : $user->password;
				$user->phone_number = $manager['sms'];
				$user->status = '1';
				$user->profile_image = '';
				/*$user->position = $manager['position'];*/
				$user->save();
				//save in store_user
//				$store->users()->detach($user->user_id);
				$store_user = [
					'is_global_manager'=> isset($manager['global_manager'])? $manager['global_manager'] : 0,
					'compte_principal'=> isset($manager['compte_principle'])? $manager['compte_principle'] : 0,
					'receive_request'=> isset($manager['receive_request'])? $manager['receive_request'] : 0,
					'reply_request'=> isset($manager['reply_request'])? $manager['reply_request'] : 0,
				];
				$managers[$user->user_id] = $store_user;


//				$store->users()->attach($user->user_id,$store_user);
			}
		}
		$removable_manager = array_diff($old_manager_id,$new_manager_id);

		if(count($removable_manager)>0){
			User::whereIn('user_id',$removable_manager)
				->delete();
		}


		if(!empty($input['store'])) {
			//save store data
			foreach ($input['store'] as $index => $store) {
				$store_model = $this->model->findOrNew(($index==0) ? $store_id:0);
				$store_model->store_name = $store['shop_name'];
				$store_model->registration_number = $store['registration_number'];
				$store_model->phone = $store['main_phone'];
				$store_model->email = $store['main_email'];
				if(!empty($input['logo_image'])){
					$store_model->logo = $store['logo_image'];
				}
				if(!empty($input['shop_image'])){
					$store_model->shop_image = $store['shop_image'];
				}
				$store_model->short_description = $store['short_description'];
				$store_model->address1 = $store['address1'];
				$store_model->address2 = $store['address2'];
				$store_model->city = $store['city'];
				$store_model->zip = $store['zip'];
				$store_model->country_id = $store['country_id'];
				$store_model->state_id = $store['state_id'];
				$store_model->latitude = $store['latitude'];
				$store_model->longitude = $store['longitude'];
				$store_model->fix_phone = $input['fix_phone'];
				$store_model->cell_phone = $input['cell_phone'];
				$store_model->tva = $input['tva'];
				$store_model->save();
				$first_store_id = ($index==0)?$store_model->store_id :$first_store_id;

				foreach ($managers as $user_id => $manager)
				{
					$store_model->users()->detach($user_id);
					$store_model->users()->attach($user_id,$manager);
				}
			}
		}
	}

	public function deleteById($store_id)
	{
		$store = $this->model->find($store_id);
		$store->users()->delete();
		$store->brands()->delete();
		$store->requestBrand()->delete();
		return $store->delete();
	}

	public function getByUserId($user_id){
		$stores = $this->model->whereHas('users',function($query) use($user_id){
			$query->where('store_users.user_id',$user_id);
		})->paginate(2);
		return $stores;
	}

	public function getCount()
	{
		return $this->model->count();
	}

	public function getDashboardStore()
	{
		return $this->model->orderBy('store_id','desc')->limit(3)->get();
	}

	public function add($input, $user_id=null)
	{
		/*add store*/
		$managers = [];
		$all_users = [];
		if($user_id==null && isset($input['manager']) && !empty($input['manager'])){
			foreach ($input['manager'] as $manager){
				$user =new User();
				$user->role_id = '2';
				$user->first_name = $manager['first_name'];
				$user->last_name = $manager['last_name'];
				$user->email = $manager['email'];
				$user->password = Hash::make($manager['password']);
				$user->phone_number = $manager['sms'];
				$user->status = '1';
				$user->profile_image = '';
				/*$user->position = $manager['position'];*/
				$user->save();
				$all_users[]=$user;
				//save in store_user
				$store_user = [
					'is_global_manager'=> isset($manager['global_manager'])? $manager['global_manager'] : 0,
					'compte_principal'=> isset($manager['compte_principle'])? $manager['compte_principle'] : 0,
					'receive_request'=> isset($manager['receive_request'])? $manager['receive_request'] : 0,
					'reply_request'=> isset($manager['reply_request'])? $manager['reply_request'] : 0,
				];
				$managers[$user->user_id] = $store_user;
			}
		}

		if($user_id!=null){
			$store_user = [
				'is_global_manager'=> 0,
				'compte_principal'=>  0,
				'receive_request'=>  0,
				'reply_request'=> 0,
			];
			$managers[$user_id] = $store_user;
		}


		/*save store*/
		$store_model = new Store();
		$store_model->store_name = $input['shop_name'];
		$store_model->registration_number = $input['registration_number'];
		$store_model->phone = $input['main_phone'];
		$store_model->email = $input['main_email'];
		$store_model->logo = (!empty($input['logo_image']))?$input['logo_image']:'';
		$store_model->shop_image = (!empty($input['shop_image'])) ? $input['shop_image'] :'';
		$store_model->short_description = $input['short_description'];
		$store_model->address1 = $input['address1'];
		$store_model->address2 = $input['address2'];
		$store_model->city = $input['city'];
		$store_model->zip = $input['zip_code'];
		$store_model->country_id = $input['country_id'];
		$store_model->state_id = $input['state_id'];
		$store_model->latitude = $input['latitude'];
		$store_model->longitude = $input['longitude'];
		$store_model->fix_phone = $input['fix_phone'];
		$store_model->cell_phone = $input['cell_phone'];
		$store_model->tva = $input['tva'];
		$store_model->created_by = null;
		$store_model->save();

		//Store opening day and opening hour in database
		$opening_day_id_array = $input['opening_day_id'];
		$opening_hour_array = $input['opening_hour'];
		$closure_hour_array = $input['closure_hour'];
		foreach ($opening_day_id_array as $key => $opening_day) {
			$store_opening_hour = new \App\StoreOpeningHour();
			$store_opening_hour->opening_hour = (isset($opening_hour_array[$key])) ? $opening_hour_array[$key] : null;
			$store_opening_hour->closure_hour = (isset($closure_hour_array[$key])) ? $closure_hour_array[$key] : null;
			$store_opening_hour->opening_day_id = $opening_day;
			$store_opening_hour->store_id = $store_model->store_id;
			$store_opening_hour->save();
		}
		

		if(!empty($managers)){
			foreach ($managers as $manager_id=>$manager){
				$store_model->users()->attach($manager_id,$manager);
			}
		}

		/*save store brand*/
		/*if(isset($input['brand_list']) && !empty($input['brand_list'])){
			foreach ($input['brand_list'] as $brand_id)
			{
				$store_model->brands()->attach($brand_id);
			}
		}

		if(!empty($input['brand_name'])){
			$this->saveBrand($input,$store_model->store_id);
		}*/
		return isset($all_users) ? $all_users : $store_model;
	}

	public function update($id, $input)
	{
		/*update user*/

		$new_manager_id = [];
		$all_users = [];
		$old_manager_id = isset($input['old_manager_id']) ? explode(',',$input['old_manager_id']) : [];
		$managers = [];
		if(isset($input['manager']) && !empty($input['manager'])){
			foreach ($input['manager'] as $manager){

				if(isset($manager['manager_id']))
				{
					$new_manager_id[] = $manager['manager_id'];
				}
				$user = User::findOrNew(isset($manager['manager_id']) ? $manager['manager_id'] : 0);
				$user->role_id = '2';
				$user->first_name = $manager['first_name'];
				$user->last_name = $manager['last_name'];
				$user->email = $manager['email'];
				$user->password = (!empty($manager['password']) && $manager['password'] != null) ?  Hash::make($manager['password']) : $user->password;;
				$user->phone_number = $manager['sms'];
				$user->status = '1';
				$user->profile_image = '';
				/*$user->position = $manager['position'];*/
				$user->save();
				$all_users[]=$user;
				//save in store_user
				$store_user = [
					'is_global_manager'=> isset($manager['global_manager'])? $manager['global_manager'] : 0,
					'compte_principal'=> isset($manager['compte_principle'])? $manager['compte_principle'] : 0,
					'receive_request'=> isset($manager['receive_request'])? $manager['receive_request'] : 0,
					'reply_request'=> isset($manager['reply_request'])? $manager['reply_request'] : 0,
				];
				$managers[$user->user_id] = $store_user;
			}
		}

		$removable_manager = array_diff($old_manager_id,$new_manager_id);
		if(count($removable_manager)>0){
			User::whereIn('user_id',$removable_manager)
				->delete();
		}

		/*update store*/
		$store_model = $this->model->findOrNew($id);
		$store_model->store_name = $input['shop_name'];
		$store_model->registration_number = $input['registration_number'];
		$store_model->phone = $input['main_phone'];
		$store_model->email = $input['main_email'];
		if(!empty($input['logo_image'])){
			$store_model->logo = $input['logo_image'];
		}
		if(!empty($input['shop_image'])){
			$store_model->shop_image = $input['shop_image'];
		}
		$store_model->short_description = $input['short_description'];
		$store_model->address1 = $input['address1'];
		$store_model->address2 = $input['address2'];
		$store_model->city = $input['city'];
		$store_model->zip = $input['zip_code'];
		$store_model->country_id = $input['country_id'];
		$store_model->state_id = $input['state_id'];
		$store_model->latitude = $input['latitude'];
		$store_model->longitude = $input['longitude'];
		$store_model->fix_phone = $input['fix_phone'];
		$store_model->cell_phone = $input['cell_phone'];
		$store_model->tva = $input['tva'];
		$store_model->save();

		$store_model->users()->detach();
		
		//Store opening day and opening hour in database
		$opening_day_id_array = $input['opening_day_id'];
		$opening_hour_id_array = $input['opening_hour_id'];
		
		$opening_hour_array = $input['opening_hour'];
		$closure_hour_array = $input['closure_hour'];
		
		foreach ($opening_day_id_array as $key => $opening_day) {
			$store_opening_hour = \App\StoreOpeningHour::findOrNew((isset($opening_hour_id_array[$key])) ? $opening_hour_id_array[$key] : 0);
			$store_opening_hour->opening_hour = (isset($opening_hour_array[$key])) ? $opening_hour_array[$key] : null;
			$store_opening_hour->closure_hour = (isset($closure_hour_array[$key])) ? $closure_hour_array[$key] : null;
			$store_opening_hour->opening_day_id = $key;
			$store_opening_hour->save();
		}
		
		/*save store user*/
		if(!empty($managers)){
			foreach ($managers as $manager_id=>$manager){
				$store_model->users()->attach($manager_id,$manager);
			}
		}
		/*$store_model->brands()->detach();
		if(isset($input['brand_list']) && !empty($input['brand_list'])){
			foreach ($input['brand_list'] as $brand_id)
			{
				$store_model->brands()->attach($brand_id);
			}
		}
		if(!empty($input['brand_name'])){
			$request_brand = RequestBrand::findOrNew($input['request_brand_id']);
			$request_brand->brand_name = $input['brand_name'];
			$request_brand->website = $input['website'];
			$request_brand->store_id =$store_model->store_id;
			$request_brand->save();
		}*/
		return $store_model;

	}

}