<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $table = 'products';

  protected $fillable = array(
    'application_type',
    'title',
    'description',
    'image1',
    'image2',
    'image3',
    'image4',
    'image5',
    'image6',
    'image7',
    'image8',
    'image9',
    'image10',
    'LOT_number',
    'UPC',
    'auto_bid',
    'pack_size',
    'sold',
    'DIN',
    'med_quantity',
    'brand_generic',
    'dosage',
    'form',
    'route',
    'medicine_manufacturer',
    'generic',
    'shop_price',
    'opening_price',
    'lowest_price',
    'currency_id',
    'admin_id',
    'confirm',
    'timelimit',
    'confirm_date'
  );

  public function Currency()
  {

    return $this->belongsTo('Currency');
  }
}
