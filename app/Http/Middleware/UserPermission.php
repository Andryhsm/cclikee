<?php
/**
 * Created by PhpStorm.
 * User: Chirag
 * Date: 5/15/2017
 * Time: 8:48 PM
 */
namespace App\Http\Middleware;

use App\Models\AdminRole;
use App\Models\PermissionRole;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class UserPermission
{
    protected $auth;
    protected $app;
    protected $guard = 'admin';

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->app = app();
    }

    public function handle($request, Closure $next)
    {
        $role_id = auth()->guard('admin')->user()->role_id;
        $role_permission = AdminRole::with('permissions')->where('admin_role_id', $role_id)->first();

        $module = [];
        foreach ($role_permission->permissions as $permisrsion) {
            $route_name = explode(',', $permisrsion->route);
            if (is_array($route_name)) {
                $module = array_merge($module, $route_name);
            }
        }
        $module[] = '404';
        $permission_array = array_filter($module);
        $this->app->bind('user_permission', function () use ($permission_array) {
            return $permission_array;
        });

        if($request->isMethod('PATCH') || $request->ajax()  || $request->isMethod('POST') || $request->isMethod('DELETE') ){
            return $next($request);
        }
        if (in_array(Route::currentRouteName(), $permission_array)) {
            return $next($request);
        }
        return Redirect::to('admin/404');
    }
}