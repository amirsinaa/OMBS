<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{

  public function postOrder()
  {

    $member_id = Auth::user()->id;
    $basket_products = \App\Models\Basket::with('Product')->where('member_id', '=', $member_id)->get();

    if (!$basket_products) {
      return Redirect::route('index')->with('error', 'Your basket is empty.');
    }

    $order_uniqid = uniqid('order_');
    foreach ($basket_products as $item) {

      $order = \App\Models\Order::create(
        array(
          'member_id' => $member_id,
          'admin_id' => $item->admin_id,
          'product_id' => $item->product_id,
          'quantity' => $item->quantity,
          'bid' => $item->bid,
          'order_uniqid' => $order_uniqid,
        )
      );
    }


    \App\Models\Basket::where('member_id', '=', $member_id)->delete();

    echo json_encode('The order is created.');

    DB::table('products')->join('order', 'products.id', '=', 'order.product_id')->update([
      'products.admin_id' => 'order.member_id'
    ]);
  }

  public function sentordersOld()
  {

    $member_id = Auth::user()->id;

    $orders = DB::table('orders')
      ->select('*')
      ->join('products', 'products.id', '=', 'orders.product_id')
      ->join('users', 'users.id', '=', 'orders.member_id')
      ->where('orders.member_id', '=', $member_id)
      ->get();
    $this->layout->content = View::make('order/sent_orders')->with('orders', $orders);
  }

  public function sentOrders()
  {

    $member_id = Auth::user()->id;

    $orders = DB::table('orders')
      ->select('order_uniqid', 'title', 'bid', 'DIN', 'shop_price', 'image1', 'quantity', 'name', 'email', 'orders.created_at as orders_created_at', 'orders.id AS order_id')
      ->join('products', 'products.id', '=', 'orders.product_id')
      ->join('users', 'users.id', '=', 'orders.member_id')
      ->where('orders.member_id', '=', $member_id)
      ->orderBy('order_uniqid')
      ->orderBy('orders.created_at', 'desc')
      ->get();

    $order_uniqid = array();
    foreach ($orders as $order) {

      $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'shop_price' => $order->shop_price, 'image1' => $order->image1, 'quantity' => $order->quantity, 'DIN' => $order->DIN, 'bid' => $order->bid, 'orders_created_at' => $order->orders_created_at);
    }


    return \View::make('order/sent_orders')->with('orders', $order_uniqid);
  }


  public function arrivedOrders()
  {

    $admin_id = Auth::user()->id;

    $orders = DB::table('orders')
      ->select('order_uniqid', 'title', 'DIN', 'image1', 'name', 'email', 'orders.id AS order_id', 'bid')
      ->join('products', 'products.id', '=', 'orders.product_id')
      ->join('users', 'users.id', '=', 'orders.member_id')
      ->where('orders.admin_id', '=', $admin_id)
      ->orderBy('order_uniqid')
      ->orderBy('orders.created_at', 'desc')
      ->get();

    $order_uniqid = array();
    foreach ($orders as $order) {

      $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1, 'DIN' => $order->DIN);
    }


    return \View::make('order/arrived_orders')->with('orders', $order_uniqid);
  }

  public function getBuyOrdersList()
  {

    $admin_id = Auth::user()->id;

    $orders = DB::table('orders')
      ->select('order_uniqid', 'title', 'name', 'DIN', 'email', 'orders.id AS order_id', 'bid')
      ->where('orders.admin_id', '=', $admin_id)
      ->join('products', 'products.id', '=', 'orders.product_id')
      ->join('users', 'users.id', '=', 'orders.member_id')
      ->orderBy('order_uniqid')
      ->orderBy('orders.created_at', 'desc')
      ->get();
    $order_uniqid = array();
    foreach ($orders as $order) {

      $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'DIN' => $order->DIN);
    }

    return \View::make('activities')->with('orders', $order_uniqid);
  }


  public function arrivedOrdersSuper()
  {

    $orders = DB::table('orders')
      ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id')
      ->join('products', 'products.id', '=', 'orders.product_id')
      ->join('users', 'users.id', '=', 'orders.member_id')
      ->orderBy('order_uniqid')
      ->orderBy('orders.created_at', 'desc')
      ->get();
    $order_uniqid = array();
    foreach ($orders as $order) {

      $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1, 'quantity' => $order->quantity);
    }

    return \View::make('order/arrived_orders_super')->with('orders', $order_uniqid);
  }

  public function orderDetail($order_uniqid, $status = 'admin')
  {
    if ($status == 'admin') {
      $admin_id = Auth::user()->id;
      $orders = DB::table('orders')
        ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id', 'member_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->join('users', 'users.id', '=', 'orders.member_id')
        ->where('orders.admin_id', '=', $admin_id)
        ->where('orders.order_uniqid', '=', $order_uniqid)
        ->get();
    } else if ($status == 'member') {
      $member_id = Auth::user()->id;
      $orders = DB::table('orders')
        ->select('order_uniqid', 'title', 'bid', 'image1', 'quantity', 'name', 'email', 'orders.id AS order_id', 'member_id')
        ->join('products', 'products.id', '=', 'orders.product_id')
        ->join('users', 'users.id', '=', 'orders.member_id')
        ->where('orders.member_id', '=', $member_id)
        ->where('orders.order_uniqid', '=', $order_uniqid)
        ->get();
    }
    $order_uniqid = array();
    foreach ($orders as $order) {
      $order_uniqid[$order->order_uniqid][] = array('name' => $order->name, 'email' => $order->email, 'title' => $order->title, 'bid' => $order->bid, 'image1' => $order->image1, 'quantity' => $order->quantity);
    }
  }

  public function getDelete($order_uniqid)
  {


    $admin_id = Auth::user()->id;

    $orderinformation = \App\Models\Order::whereRaw('order_uniqid="' . $order_uniqid . '" AND admin_id=' . $admin_id)->first();

    //echo $orderinformation->admin_id . ", " . Auth::user()->id;

    if (isset($orderinformation->admin_id) &&  $orderinformation->admin_id == Auth::user()->id) {
      $res = \App\Models\Order::whereRaw('order_uniqid="' . $order_uniqid . '" AND admin_id=' . $admin_id)->delete();

      //var_dump($res);

      return Redirect::route('arrived_orders');
    } else {

      return Redirect()->back()->with(['message' => 'You can\'t delete this order!']);
    }
  }

  public function getDeleteSuper($order_uniqid)
  {


    $res = \App\Models\Order::whereRaw('order_uniqid="' . $order_uniqid . '"')->delete();

    return Redirect::route('superadminorders');
  }
}
