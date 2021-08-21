<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\SendNewUserNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{

  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
      SendNewUserNotification::class,
    ],
  ];
  public function boot()
  {
    parent::boot();
  }
}
