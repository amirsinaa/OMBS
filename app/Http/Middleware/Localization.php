<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;


class Localization
{


  public function handle($request, Closure $next)
  {
    if (Session::has('applocale') and array_key_exists(Session::get('applocale'), Config::get('languages'))) {
      App::setLocale(Session::get('applocale'));
    } else {
      App::setLocale(Config::get('app.fallback_locale'));
    }
    return $next($request);
  }
}
