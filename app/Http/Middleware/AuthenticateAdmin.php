<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AuthenticateAdmin
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	protected $auth;
	protected $guard = 'admin';

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	public function handle($request, Closure $next)
	{
		if (auth()->guard('admin')->check()) { // check that user is logged in
			return $next($request);
		}
		return redirect()->to('admin/login')->withFlashDanger('You are not authorized to access this page.');

	}
}
