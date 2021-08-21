<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

  protected $table = 'orders';

  protected $fillable = array('member_id', 'product_id', 'admin_id', 'quantity', 'bid', 'message', 'order_uniqid');

  public function orderItems()
  {

    return $this->belongsTo('Product', 'product_id');
  }

  public function Product()
  {
    return $this->belongsTo('\App\Models\Product', 'product_id');
  }

  public function User()
  {
    return $this->belongsTo('User', 'member_id');
  }
}
