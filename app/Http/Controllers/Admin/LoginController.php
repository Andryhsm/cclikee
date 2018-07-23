<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    protected $redirectTo = '/admin';

    public function index()
    {
        return view('admin.auth.login');
    }


    public function store(Request $request)
    {

        if (!empty($request->get('email')) && $request->get('password')) {
            $auth = Auth::guard('admin');
            $credentials = [
                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'is_active' => '1'
            ];

            if (!$auth->attempt($credentials)) {
                return Redirect::back()
                    ->withInput()->withErrors('Your email address/password combination is incorrect.');
            }
            $user = $auth->getLastAttempted();
            $auth->login($user, $request->has('memory'));
            return redirect()->route('dashboard');
        }
        return Redirect::back()
            ->withErrors('Your email address/password combination is incorrect.')
            ->withInput();

    }


    public function destroy()
    {
		$auth = auth()->guard('admin');
		$auth->logout();
		session()->flush();
		flash()->success(config('message.admin-user.success-logout'));
		return redirect()->to('admin/login');
    }
}
