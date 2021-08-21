<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AddedToBasketNotification extends Notification
{
  use Queueable;

  public function __construct($basket)
  {
    $this->basket = $basket;
  }

  public function via($notifiable)
  {
    return ['database'];
  }

  public function toArray($notifiable)
  {
    return [];
  }
}
