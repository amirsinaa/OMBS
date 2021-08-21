<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BidController extends Controller
{

  public function mainIndex()
  {
    $admin_id = Auth::user()->id;

    $main_bid_products = DB::table('bids')
      ->select('products.id as product_id', 'title', 'currency', DB::raw(" MAX(price) AS maxbidprice"), DB::raw(" COUNT(products.id) AS bids_count"), 'opened')
      ->where('bids.admin_id', '=', $admin_id)
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->groupBy('products.id', 'title', 'currency', 'opened')
      ->orderBy('products.id', 'asc')
      ->get();

    return \View::make('bid/mainindex')->with('main_bid_products', $main_bid_products);
  }
  public function mainSent()
  {
    $admin_id = Auth::user()->id;

    $main_bid_products = DB::table('bids')
      ->select('products.id as product_id', 'title', 'image1', 'currency', DB::raw(" MAX(price) AS maxbidprice"), DB::raw(" COUNT(products.id) AS bids_count"))
      ->where('bids.member_id', '=', $admin_id)
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->groupBy('products.id', 'title', 'image1', 'currency')
      ->orderBy('products.title', 'asc')
      ->get();

    return \View::make('bid/mainsent')->with('main_bid_products', $main_bid_products);
  }

  public function arrivedBids($product_id)
  {

    $admin_id = Auth::user()->id;

    $bid_products = DB::table('bids')
      ->select('bids.member_id as member_id', 'bids.admin_id as admin_id', 'bids.id as bidsid', 'products.id as product_id', 'price', 'bids.message as message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency', 'bid_id_count')
      ->where('bids.admin_id', '=', $admin_id)
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
      ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
      ->leftJoin(DB::raw('(SELECT  count(bid_id) as bid_id_count, bid_id  FROM messages GROUP BY bid_id ) ResultMessage'), function ($join) {
        $join->on('bids.id', '=', 'ResultMessage.bid_id');
      })

      ->where('products.id', '=', $product_id)
      ->orderBy('bids.created_at', 'desc')
      ->get();

    return \View::make('bid/arrived_bids')->with('bid_products', $bid_products);
  }

  public function sentBids($product_id)
  {

    $admin_id = Auth::user()->id;

    $bid_products = DB::table('bids')
      ->select('bids.id as bidsid', 'products.id as product_id', 'price', 'bids.message as message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency', 'bid_id_count')
      ->where('bids.member_id', '=', $admin_id)
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
      ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
      ->leftJoin(DB::raw('(SELECT  count(bid_id) as bid_id_count, bid_id  FROM messages GROUP BY bid_id ) ResultMessage'), function ($join) {
        $join->on('bids.id', '=', 'ResultMessage.bid_id');
      })

      ->where('products.id', '=', $product_id)
      ->orderBy('bids.created_at', 'desc')
      ->get();
    return \View::make('bid/sent_bids')->with('bid_products', $bid_products);
  }

  public function superadminGetIndex()
  {

    $main_bid_products = DB::table('bids')
      ->select('products.id as product_id', 'title', 'image1', 'currency', DB::raw(" COUNT(products.id) AS bids_count"))

      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->groupBy('products.id', 'title', 'image1', 'currency')
      ->orderBy('products.title', 'asc')
      ->get();

    return \View::make('bid/superadminindex')->with('main_bid_products', $main_bid_products);
  }

  public function superBid($product_id)
  {

    $bid_products = DB::table('bids')
      ->select('bids.id as bidsid', 'products.id as product_id', 'price', 'bids.message as message', 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name ', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency', 'bid_id_count')
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
      ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
      ->leftJoin(DB::raw('(SELECT  count(bid_id) as bid_id_count, bid_id  FROM messages GROUP BY bid_id ) ResultMessage'), function ($join) {
        $join->on('bids.id', '=', 'ResultMessage.bid_id');
      })

      ->where('products.id', '=', $product_id)
      ->orderBy('bids.created_at', 'desc')
      ->get();
    return \View::make('bid/super_bid')->with('bid_products', $bid_products);
  }

  public function add()
  {

    $rules = array(
      'product' => 'required|numeric|exists:products,id',
      'price' => 'required|numeric',
    );


    $validator = Validator::make(Input::all(), $rules);

    $product_id = Input::get('product');

    if ($validator->fails()) {
      return Redirect::to('product/' . $product_id)->with('error', trans('c.The bid is not valid!'))->withInput();
    }

    $member_id = Auth::user()->id;

    $product = \App\Models\Product::find($product_id);
    $price = Input::get('price');
    $minprice = Input::get('minprice');

    if ($price < $minprice) {
      return Redirect::to('product/' . $product_id)->with('error', trans('c.The price smaller than min price!'))->withInput();
    }

    $current_message = Input::get('message');

    if (!isset($current_message)) {
      $current_message = '';
    }

    \App\Models\Bid::create(
      array(
        'member_id' => $member_id,
        'admin_id' => Input::get('admin_id'),
        'product_id' => $product_id,
        'price' => $price,
        'message' => $current_message,
      )
    );

    $data = array();

    $user = \App\Models\User::find(Auth::user()->id);

    return Redirect::route('/dashboard')->with('message', trans('c.Thank you for your bid'));
  }

  public function getDelete($id, $bid_type)
  {
    $admin_id = Auth::user()->id;
    $res = \App\Models\Bid::whereRaw('id=' . $id . ' AND admin_id =' . $admin_id)->delete();
    return Redirect::to('mainbids');
  }

  public function getDeleteSuper($id)
  {

    $res = \App\Models\Bid::whereRaw('id=' . $id)->delete();

    return Redirect::to('superadminbids');
  }

  public function publicBidList()
  {

    $bid_products = DB::table('bids')
      ->select('bids.id as bidsid', 'products.id as product_id', 'fix_price_status', 'products.opening_price AS opening_price', 'price', 'timelimit', DB::raw("DATEDIFF(timelimit, NOW() ) AS daydiff "), 'bids.created_at as bids_created_at', 'title', 'image1', 'costumer.email as cost_email', 'costumer.name as cost_name', 'costumer.id as customer_id', 'owner.name as owner_name', 'owner.id as owner_id', 'currency')
      ->join('products', 'products.id', '=', 'bids.product_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->join('users as costumer', 'costumer.id', '=', 'bids.member_id')
      ->join('users as owner', 'owner.id', '=', 'bids.admin_id')
      ->orderBy('bids.created_at', 'desc')
      ->paginate(10);

    return \View::make('bid/public_bid_list')->with('bid_products', $bid_products);
  }
}
