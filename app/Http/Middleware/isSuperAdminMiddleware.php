<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Support\Facades\Redirect;

class isSuperAdminMiddleware
{

  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {

    if (!Auth::check()) {

      return Redirect::to('/');
    }
    if (Auth::check() && (int)Auth::user()->admin !== 2) {
      Auth::logout();
      return Redirect::to('/');
    }
    return $next($request);
  }
}
