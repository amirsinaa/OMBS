<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Orderinformation extends Model
{

  protected $table = 'order_information';

  protected $fillable = array(
    'member_id',
    'firstname',
    'lastname',
    'street',
    'city',
    'postal_code',
    'email',
    'delivery_firstname',
    'delivery_lastname',
    'delivery_street',
    'delivery_city',
    'delivery_postal_code',
    'payment_type'
  );
}
