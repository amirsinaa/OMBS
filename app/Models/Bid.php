<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{

  protected $table = 'bids';

  protected $fillable = array('member_id', 'admin_id', 'product_id', 'price', 'message');

  public function Product()
  {

    return $this->belongsTo('Product', 'product_id');
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
