<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

  public function isSuperAdmin()
  {
    return $this->admin == 2;
  }

  protected $table = 'users';

  public function getEmail()
  {
    return $this->email;
  }

  public function getAccNum()
  {
    return $this->ACC_NUM;
  }

  protected $fillable = array('email', 'password', 'city', 'country', 'postal_code', 'province', 'ACC_NUM', 'pharma_address', 'phone_number', 'name', 'admin', 'currency_id');

  protected $hidden = array('password');

  public function getAuthIdentifier()
  {
    return $this->getKey();
  }

  public function getAuthPassword()
  {
    return $this->password;
  }

  public function getReminderEmail()
  {
    return $this->email;
  }

  public function getRememberToken()
  {
    return $this->remember_token;
  }

  public function setRememberToken($value)
  {
    $this->remember_token = $value;
  }


  public function getRememberTokenName()
  {
    return 'remember_token';
  }


  public function profiles()
  {
    return $this->hasMany('Profile');
  }

  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = \Hash::make($value);
  }
}
