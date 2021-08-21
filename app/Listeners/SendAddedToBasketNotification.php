<?php

namespace App\Listeners;

use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddedToBasketNotification;

class SendAddedToBasketNotification
{

  public function handle($event)
  {
    $users = User::join('basket as costumer', 'costumer.member_id', '=', 'user.id')->get();

    Notification::send($users, new AddedToBasketNotification($event->basket));
  }
}
