<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Input;

class OrderinformationController extends Controller
{

  public function get()
  {

    $member_id = Auth::user()->id;

    $result = \App\Models\Orderinformation::where('member_id', '=', $member_id)->first();

    echo json_encode($result);
  }

  public function add()
  {


    $member_id = Auth::user()->id;

    $result = \App\Models\Orderinformation::where('member_id', '=', $member_id)->first();

    if (empty($result)) {
      \App\Models\Orderinformation::create(
        array(
          'member_id' => $member_id,
        )
      );

      echo 'created';
    } else {
      echo 'earlier created';
    }
  }

  public function edit()
  {

    $member_id = Auth::user()->id;


    $orderinformation = \App\Models\Orderinformation::where('member_id', '=', $member_id)->first();



    if (Input::get('order_information_type') == 1) {
      $orderinformation->firstname = Input::get('firstname') ?: ' ';
      $orderinformation->lastname = Input::get('lastname') ?: ' ';
      $orderinformation->street = Input::get('street') ?: ' ';
      $orderinformation->city = Input::get('city') ?: ' ';
      $orderinformation->postal_code = Input::get('postal_code') ?: ' ';
      $orderinformation->email = Input::get('email') ?: ' ';
      $orderinformation->delivery_firstname = Input::get('delivery_firstname') ?: ' ';
      $orderinformation->delivery_lastname = Input::get('delivery_lastname') ?: ' ';
      $orderinformation->delivery_street = Input::get('delivery_street') ?: ' ';
      $orderinformation->delivery_city = Input::get('delivery_city') ?: ' ';
      $orderinformation->delivery_postal_code = Input::get('delivery_postal_code') ?: ' ';
      $orderinformation->message = Input::get('message') ?: ' ';
    } else if (Input::get('order_information_type') == 2) {
      $orderinformation->payment_type = Input::get('payment_type') ?: 0;
    } else if (Input::get('order_information_type') == 3) {
      $orderinformation->firstname = Input::get('firstname') ?: ' ';
      $orderinformation->lastname = Input::get('lastname') ?: ' ';
      $orderinformation->street = Input::get('street') ?: ' ';
      $orderinformation->city = Input::get('city') ?: ' ';
      $orderinformation->postal_code = Input::get('postal_code') ?: ' ';
      $orderinformation->email = Input::get('email') ?: ' ';
      $orderinformation->delivery_firstname = Input::get('delivery_firstname') ?: ' ';
      $orderinformation->delivery_lastname = Input::get('delivery_lastname') ?: ' ';
      $orderinformation->delivery_street = Input::get('delivery_street') ?: ' ';
      $orderinformation->delivery_city = Input::get('delivery_city') ?: ' ';
      $orderinformation->delivery_postal_code = Input::get('delivery_postal_code') ?: ' ';
      $orderinformation->payment_type = Input::get('payment_type') ?: ' ';
      $orderinformation->message = Input::get('message') ?: ' ';
    }
    $orderinformation->save();

    echo ' information saved';
  }
}
