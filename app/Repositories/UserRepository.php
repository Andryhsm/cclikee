<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Product;
use App\User;
use Carbon\Carbon;
use App\UserAddress;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getByRole($role_id)
    {
        return User::where('role_id', '=', $role_id)->get();
    }

    public function getByEmail($email)
    {
        return User::where('email', $email)->get()->first();
    }

    public function getById($id)
    {
		return User::with('address')->where('user_id', $id)->get()->first();
    }

    public function create($input, $image_name)
    {
        $this->model->role_id = '1';
        $this->model->first_name = $input['first_name'];
        $this->model->last_name = $input['last_name'];
        $this->model->email = $input['email'];
        $this->model->status = isset($input['is_active']) ? $input['is_active'] : '0';
        $this->model->password = Hash::make($input['password']);
        $this->model->profile_image = $image_name;
        $this->model->radius = $input['radius'];
		$this->model->phone_number = $input['phone_number'];
		$this->model->save();

		$user_address = new UserAddress();
		$user_address->first_name = $input['first_name'];
		$user_address->last_name = $input['last_name'];
		$user_address->company = isset($input['company']) ? $input['company'] : null;
		$user_address->phone = $input['phone_number'];
		$user_address->address1 = $input['address1'];
		$user_address->address2 = $input['address2'];
		$user_address->city = $input['city'];
		$user_address->state_id = $input['state_id'];
		$user_address->country_id = $input['country_id'];
		$user_address->zip = $input['zip'];
		$this->model->address()->save($user_address);

        return $this->model;
    }

    public function update($id, $input, $image_name)
    {
        $user = $this->model->findOrNew($id);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email_address'];
        $user->role_id = '1';
        $user->status = isset($input['is_active']) ? $input['is_active'] : '0';
		$user->password = (!empty($input['password'])) ? Hash::make($input['password']) : $user->password;
        if (!empty($image_name)) {
            $user->profile_image = $image_name;
        }
		$user->radius = $input['radius'];
		$user->phone_number = $input['phone_number'];
		$user->save();

		$user_address = UserAddress::findOrNew(isset($input['user_address_id']) ? $input['user_address_id'] : 0);
		$user_address->first_name = $input['first_name'];
		$user_address->last_name = $input['last_name'];
		$user_address->company = isset($input['company']) ? $input['company'] : null;
		$user_address->phone = $input['phone_number'];
		$user_address->address1 = $input['address1'];
		$user_address->address2 = $input['address2'];
		$user_address->city = $input['city'];
		$user_address->state_id = $input['state_id'];
		$user_address->country_id = $input['country_id'];
		$user_address->zip = $input['zip'];
		$user->address()->save($user_address);

        return $user;
    }

    public function delete($id)
    {

        return $this->model->find($id)->delete();
    }

    public function saveUser($input){

        $this->model->role_id = $input['role_id'];
        $this->model->first_name = $input['first_name'];
        $this->model->last_name = $input['last_name'];
        $this->model->email = $input['email'];
		$this->model->radius = (Cookie::has('distance')) ? Cookie::get('distance') : null;
        $this->model->status = isset($input['is_active']) ? $input['is_active'] : '0';
        $this->model->password = Hash::make($input['password']);
		$this->model->phone_number = $input['phone_number'];
		$this->model->gender = $input['gender'];
		$this->model->birthday = Carbon::parse($input['birthday']);
        $this->model->save();

		$user_address = new UserAddress();
		$user_address->first_name = $input['first_name'];
		$user_address->last_name = $input['last_name'];
		$user_address->phone = '';
		$user_address->address1 = '';
		$user_address->city = '';
		$user_address->state_id = 0;
		$user_address->country_id = 0;
		$user_address->zip = (Cookie::has('zip_code')) ? Cookie::get('zip_code') : null;
		$this->model->address()->save($user_address);

        return $this->model;
    }

    public function saveUserBySocialMedia($input, $provider)
    {
        $this->model->role_id = Session::get('role_user');
        $this->model->first_name = (!empty($input['first_name']))?$input['first_name']:$input['name'];
        $this->model->last_name =  (!empty($input['last_name']))?$input['last_name']:$input['name'];
        $this->model->email = $input['email'];
        $this->model->social_media_id = $input['id'];
        $this->model->register_by = $provider;
        $this->model->status = 1;
        $this->model->password = Hash::make('123456');
        $this->model->save();
        return $this->model;
    }

    public function getCountByRole($role_id)
	{
		return $this->model->where('role_id',$role_id)->count();
	}
	public function getDashboardCustomers()
	{
		return $this->model->orderby('user_id','desc')->limit(8)->get();
	}

	public function getAllMerchants()
	{
		return $this->model->whereHas('store')->with('store')->where('role_id',2)->get();
	}
}