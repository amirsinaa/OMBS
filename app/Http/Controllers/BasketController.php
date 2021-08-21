<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class BasketController extends Controller
{

  public function basketfull()
  {
    $member_id = Auth::user()->id;

    $result = \App\Models\Orderinformation::where('member_id', '=', $member_id)->first();
    if (empty($result)) {
      \App\Models\Orderinformation::create(
        array(
          'member_id' => $member_id,
        )
      );
    }

    return \View::make('basket/basketfull');
  }

  public function superadminGetIndex()
  {

    $bid_products = DB::table('bids')
      ->select('bids.id as bidsid', 'price', 'message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'owner.name as owner_name', 'currency')
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
      ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
      ->orderBy('bids.created_at', 'desc')
      ->get();

    $this->layout->content = View::make('bid/superadminindex')->with('bid_products', $bid_products);
  }


  public function basketGet()
  {

    $my_id = Auth::user()->id;

    $basket = DB::table('basket')
      ->select('bid', 'basket.id as basketid', 'quantity', 'products.shop_price AS price', 'basket.created_at as basket_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency')
      ->where('basket.member_id', '=', $my_id)
      ->join('products', 'products.id', '=', 'basket.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->join('users as costumer', 'costumer.id', '=', 'basket.member_id')
      ->join('users as owner', 'owner.id', '=', 'basket.admin_id')
      ->orderBy('basket.created_at', 'desc')
      ->get();

    echo json_encode($basket);
  }
  public function basketPost(Request $request)
  {
    if ($request->isMethod('post')) {
      $idArr = Input::get('id');
      $quantityArr = Input::get('quantity');

      foreach ($idArr as $key => $id) {
        $update = \App\Models\Basket::find($id);
        $update->quantity = $quantityArr[$key];
        $update->save();
      }

      echo 'Basket saved';
    }
  }

  public function add()
  {

    \App\Models\Basket::create(
      array(
        'member_id' => Input::get('member_id'),
        'admin_id' => Input::get('admin_id'),
        'product_id' => Input::get('product_id'),
        'quantity' => 1,
        'bid' => Input::get('bid'),
      )
    );
    DB::table('products')->join('basket', 'products.id', '=', 'basket.product_id')->update([
      'products.sold' => 1,
      'products.opened' => 0
    ]);

    echo "The product is in the Bidder's basket.";

    $data = array();

    $email = Input::get('email');
  }
  public function getDelete($id)
  {

    $member_id = Auth::user()->id;

    $res = \App\Models\Basket::whereRaw('id=' . $id . ' AND member_id=' . $member_id)->delete();

    return Redirect::route('basket/basketfull');
  }
}
