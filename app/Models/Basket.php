<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{

  protected $table = 'basket';

  protected $fillable = array('member_id', 'admin_id', 'product_id', 'quantity', 'bid');


  public function Product()
  {

    return $this->belongsTo('\App\Models\Product', 'product_id');
  }

  public function User()
  {

    return $this->belongsTo('User', 'member_id');
  }

  public function Owner()
  {

    return $this->belongsTo('User', 'admin_id');
  }

  public function scopeBestbid($query, $product_id)
  {
    return $query->where('product_id', '=', $product_id)->max('price');
  }
}
