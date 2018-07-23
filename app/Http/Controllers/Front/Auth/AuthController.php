<?php

namespace App\Http\Controllers\front\Auth;

use App\Events\UserRegistered;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Event;
use Laravel\Socialite\Facades\Socialite;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\RegionRepositoryInterface;
use App\BrandTag;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    protected $user_repository;
    public function __construct(UserRepository $user_repository,RegionRepositoryInterface $region_repo, BrandRepositoryInterface $brand_repo){
        $this->user_repository=$user_repository;
        $this->region_repository = $region_repo;
        $this->brand_repository = $brand_repo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        //
        return view('front.auth.content');
    }

    public function getMerchantLogin()
	{
        $countries = $this->region_repository->getCountries();
        $store = false;
        $brands = $this->brand_repository->lists();
        $brand_tags = BrandTag::get();
		return view('merchant.content', compact('countries', 'store', 'brands', 'brand_tags'));
	}

	public function postMerchantLogin(Request $request)
	{
		$rules = array(
			'email' => 'required',
			'password' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
        
		if ($validator->fails()) {
			return Redirect::back()->withInput()->withErrors($validator);
		} else {
			if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'status' => '1','role_id'=>'2'])) {
				$user = Auth::getLastAttempted();
				Auth::login($user, $request->has('memory'));
				Session::put('store_to_user', $user->store[0]->store_id);
				return redirect()->route('merchant-dashboard');
			}
		}
		return Redirect::back()
			->withInput()->withErrors('Your email address/password combination is incorrect.');
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('front.auth.register')->with('role_id',1);
    }

    public function postLogin(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'status' => '1','role_id'=>'1'])) {
				$user = Auth::getLastAttempted();
                //add_info_cookie_area($user->address->zip, $user->radius);
                Auth::login($user, $request->has('memory'));
				$intended_url = \Session::get('url.intended', '');
				if(!Cookie::has('zip-code') && !Cookie::has('radius')){
				    add_area_in_cookie($user->address->zip, $user->radius);
                }else{
                    $user = \App\User::find(auth()->user()->user_id);
                    $user->radius = Cookie::get('radius');
                    $user->save();
                    $user_address = $user->address;
                    $user_address->zip = Cookie::get('zip-code');
                    $user_address->save();
                }
				if (ends_with($intended_url, 'caisse/confirmation')) {
					return redirect()->route('cart');
				}
				if(\Session::has('ask-product')){
					$ask_product = \Session::get('ask-product');
					return redirect()->route('ask-product-search', ['keyword' => $ask_product['keyword']]);
					//return Redirect::to('ask-product/search?keyword='.$ask_product['keyword']);
				}
				return redirect()->route('customer-commande-en-cours');
            }
        }
        return Redirect::back()
            ->withInput()->withErrors('Your email address/password combination is incorrect.');
    }

    public function saveUser(Request $request)
    {
        $rules = array(
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'g-recaptcha-response'=>'required|recaptcha'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } else {
            try {
                $user = $this->user_repository->saveUser($request->all());
                //add_info_cookie_area($user->address->zip, $user->radius);
                Event::fire(new UserRegistered($user));
				Auth::login($user);
				flash()->success(trans('form.register_success_message'));
			} catch (\Exception $e) {
                flash()->error(trans('form.register_error_message'));
                return Redirect::back();
                //dd($e->getMessage());
            }
            return redirect()->route('customer-commande-en-cours');
        }
    }


    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if($provider == 'google' || $provider == 'facebook')
            $user = Socialite::driver($provider)->stateless()->user();
        else
            $user = Socialite::driver($provider)->user();
        $authUser = $this->findOrCreateUser($user, $provider);    
        Auth::login($authUser, true);
        flash()->success(config('message.user.success-login'));
        \Session::forget('role_id');
        return redirect()->route('home');
    }

    public function findOrCreateUser($user, $provider)
    {
        $users = $this->user_repository->getByEmail($user->email);
        if ($users) {
            return $users;
        }
        $user = ($provider == 'google') ? $this->getGoogleUser($user) : $this->getUser($user);
        try{
            $user_data = $this->user_repository->saveUserBySocialMedia($user, $provider);
            return $user_data;
        }catch (\Exception $e){
            flash()->error($e->getMessage());
        }


    }

    public function getUser($user)
    {
        $user_data = [];
        if (!empty($user)) {
            $name = $this->getFirstAndLastname($user->name);
            $user_data['first_name'] = (!empty($name[0])) ? $name[0] : null;
            $user_data['last_name'] = (!empty($name[1])) ? $name[1] : $name[0];
            $user_data['email'] = ($user->email != null) ? $user->email : $user_data['first_name']."".ucfirst($user_data['last_name'])."@alternateeve.com";
            $user_data['id'] = $user->id;
        }
        return $user_data;
    }

    public function getGoogleUser($user)
    {
        $user_data = [];
        if (!empty($user)) {
            $user_data['first_name'] = $user->user['name']['givenName'];
            $user_data['last_name'] = $user->user['name']['familyName'];
            $user_data['email'] = $user->email;
            $user_data['id'] = $user->id;
        }
        return $user_data;
    }

    public function getFirstAndLastname($full_name)
    {
        return array_values(array_filter(explode(" ", $full_name)));
    }

    public function destroy()
    {
    	$user =  Auth::user();
        Auth::logout();
		\Session::flush();
		flash()->success(config('message.user.success-logout'));
		if($user->role_id=='2')
		{
			return redirect()->route('merchant-login');
		} else {
			return redirect()->route('login');
		}
    }
    
    public function loginInMerchant(){
        $user =  Auth::user();
        Auth::logout();
    	\Session::flush();
    	flash()->success(config('message.user.success-logout'));
    	return redirect()->route('merchant-login');
    }
}

