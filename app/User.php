<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  protected $fillable = [
    'name',
    'email',
    'password',
    'city',
    'country',
    'postal_code',
    'province',
    'pharma_address',
    'phone_number',
    'ACC_NUM'
  ];

  protected $hidden = [
    'password', 'remember_token',
  ];

  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
}
