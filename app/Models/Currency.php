<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{

  protected $table = 'currency';

  public function getCurrencyFullNameAttribute()
  {
    return ' [' . $this->attributes['code'] . ']  ' . $this->attributes['currency'] . ' ' . $this->attributes['country'];
  }
}
