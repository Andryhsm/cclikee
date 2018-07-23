<?php

namespace App\Http\Middleware;
use Closure;
use App\System\Models\Store;
use App;
use Event;
use Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;
class VerifyStore
{
    protected $app;
    public function __construct()
    {
        $this->app = app();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		LaravelLocalization::setLocale('fr');
		
		$language_code = LaravelLocalization::getCurrentLocale();
		if(!$request->hasCookie('language') || ($request->cookie('language')->language_code!=$language_code))
		{
			$language=App\Models\Language::where("language_code", $language_code)->first();
		} else {
			$language = $request->cookie('language');
		}

/*        if($request->has('language')){
			$language=App\Models\Language::where("language_code", $language_code)->first();
		}elseif ($request->hasCookie('language')) {
			$language = $request->cookie('language');
		}*/

        if (!isset($language) || $language == null) {
            $language = App\Models\Language::where("language_code", 'en')->first();
        }

        $this->app->singleton('language', function () use ($language) {
            return $language;
        });
        app()->setLocale($language->language_code);
        // if (!$request->hasCookie('language') || ($request->hasCookie('language') && $request->    cookie('language')->language_id != $language->language_id)) {
        //     return \Redirect::to($request->url())->withCookie(cookie()->forever('language', $language));
        // }
        //dd($request);
        return $next($request);
    }
}