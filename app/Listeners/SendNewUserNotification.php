<?php

namespace App\Listeners;

use App\User;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Notification;


class SendNewUserNotification
{

  public function handle($event)
  {
    $admins = User::where('admin', 2)->get();

    Notification::send($admins, new NewUserNotification($event->user));
  }
}
