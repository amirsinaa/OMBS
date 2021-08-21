<?php

namespace App\Http\Traits;

use DB;

trait SellerTrait
{
  public function sellersAll()
  {

    $sellers = DB::table('users')
      ->select('users.id as id', 'users.name as name')
      ->distinct()
      ->join('products', 'products.admin_id', '=', 'users.id')
      ->orderBy('name', 'asc')
      ->get();

    return $sellers;
  }
}
