<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
  use Queueable;

  public function __construct($user)
  {
    $this->user = $user;
  }

  public function via($notifiable)
  {
    return ['database'];
  }

  public function toArray($notifiable)
  {
    return [
      'name' => $this->user->name,
      'ACC_NUM' => $this->user->ACC_NUM,
      'province' => $this->user->province,
      'pharma_address' => $this->user->pharma_address,
      'country' => $this->user->country,
      'city' => $this->user->city,
      'postal_code' => $this->user->postal_code,
      'phone_number' => $this->user->phone_number,
      'email' => $this->user->email
    ];
  }
}
