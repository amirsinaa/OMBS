<?php

namespace App\Providers;

use App\Http\Traits\SellerTrait;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

  use SellerTrait;

  public function register()
  {
  }

  public function boot()
  {
    view()->composer('*', function ($view) {
      $sellers = $this->sellersAll();
      $applocale = session()->get('applocale');
      $view->with(compact('applocale', 'sellers'));
    });

    if ($this->app->environment('production')) {
      \URL::forceScheme('https');
    }
  }
}
