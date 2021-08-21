<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{

  public function get($bid_id = '')
  {

    $messages = \App\Models\Message::with('Sender')->where('bid_id', '=', $bid_id)->orderBy('created_at', 'asc')->get();

    return response()->json([
      'messages' => $messages,
    ], 200);
  }

  public function add(Request $request, $bid_id = '', $recipient_id = '', $product_id = '')
  {

    if ($request->isMethod('post')) {
      $member_id = Auth::user()->id;

      \App\Models\Message::create(
        array(
          'bid_id' => Input::get('bid_id'),
          'sender_id' => $member_id,
          'recipient_id' => Input::get('recipient_id'),
          'message' => Input::get('message'),
        )
      );

      $data = array();

      $recipient = \App\Models\User::find(Input::get('recipient_id'));


      return Redirect::to('bids/' . Input::get('product_id'))->with('message', 'Message has been sent.');
    }
    return \View::make('message/add', array('bid_id' => $bid_id, 'recipient_id' => $recipient_id, 'product_id' => $product_id));
  }

  public function add2(Request $request)
  {

    if ($request->isMethod('post')) {

      $rules = array(
        'email' => 'required',
        'message' => 'required',
        'captcha' => 'required|captcha',
      );
      $inputs = Input::all();
      $messages = array('captcha' => 'The :attribute is invalid');
      $validation = Validator::make($inputs, $rules, $messages);

      if (!$validation->passes()) {
        $message[] = $validation->messages()->all();
        echo join('<br>', $message[0]);
      } else {

        \App\Models\Message2::create(
          array(
            'admin_id' => Input::get('admin_id'),
            'email' => Input::get('email'),
            'message' => Input::get('message'),
          )
        );

        echo 'OK  Message has been sent.';
      }
    }
  }

  public function visitorMessageList()
  {
    $admin_id = Auth::user()->id;

    $message_list = DB::table('messages2')
      ->select()
      ->where('admin_id', '=', $admin_id)
      ->orderBy('created_at', 'desc')
      ->get();


    return \View::make('message/visitor_message_list')->with(array('message_list' => $message_list));
  }
}
