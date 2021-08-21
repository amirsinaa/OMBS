<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

  public function getlogin()
  {

    return \View::make("user/login");
  }

  public function postLogin()
  {
    $email = Input::get('email');
    $password = Input::get('password');

    if (Auth::attempt(array('email' => $email, 'password' => $password))) {

      if (Auth::user()->admin == 2) {

        return Redirect::intended('superadminarea');
      } else {

        $application_type = session()->get('application_type');
        if (empty($application_type)) {
          return Redirect::intended('/dashboard');
        } else {
          return Redirect::to('/index/' . $application_type);
        }
      }
    } else {

      \Session::flash('flash_message_danger', trans('c.Please check your password & email'));
      return Redirect::route('index');
    }
  }


  public function news()
  {
    return \View::make("user/news");
  }


  public function about()
  {
    return \View::make('about');
  }

  public function getLogout()
  {
    Auth::logout();
    return Redirect::route('index');
  }

  public function create()
  {
    return \View::make('user.create');
  }


  public function store()
  {

    $data = Input::all();
    $validator = Validator::make($data, array('name' => 'unique:users'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.This Username exists!'))->withInput();
    }

    $validator = Validator::make($data, array('name' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.The name input is empty!'))->withInput();
    }

    $validator = Validator::make($data, array('email' => 'unique:users'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.This Email exists!'))->withInput();
    }

    $validator = Validator::make($data, array('province' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'province is required')->withInput();
    }

    $validator = Validator::make($data, array('phone_number' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'phone_number is required')->withInput();
    }

    $validator = Validator::make($data, array('pharma_address' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'pharma_address is required')->withInput();
    }

    $validator = Validator::make($data, array('country' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'country is required')->withInput();
    }

    $validator = Validator::make($data, array('city' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'city is required')->withInput();
    }

    $validator = Validator::make($data, array('postal_code' => 'unique:users'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'postal_code already exits !! ')->withInput();
    }

    $validator = Validator::make($data, array('postal_code' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'postal_code is required')->withInput();
    }

    $validator = Validator::make($data, array('ACC_NUM' => 'unique:users'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'ACC_NUM already exits !! ')->withInput();
    }

    $validator = Validator::make($data, array('ACC_NUM' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', 'ACC_NUM is required')->withInput();
    }

    $validator = Validator::make($data, array('email' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.The Email is empty!'))->withInput();
    }

    $validator = Validator::make($data, array('email' => 'email'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.The Email address is not valid!'))->withInput();
    }

    $validator = Validator::make($data, array('password' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.The Password is empty!'))->withInput();
    }

    $validator = Validator::make($data, array('password_confirmation' => 'required'));
    if ($validator->fails()) {
      return Redirect::to('/user/create')->with('error', trans('c.The Password confirmation is empty!'))->withInput();
    }

    if (Input::get('password') == Input::get('password_confirmation')) {
      $user = new \App\Models\User;

      $user->name = Input::get('name');
      $user->ACC_NUM = Input::get('ACC_NUM');
      $user->city = Input::get('city');
      $user->country = Input::get('country');
      $user->postal_code = Input::get('postal_code');
      $user->province = Input::get('province');
      $user->phone_number = Input::get('phone_number');
      $user->pharma_address = Input::get('pharma_address');
      $user->email = Input::get('email');
      $user->password = Input::get('password');
      $user->admin = 1;
      $user->remember_token = '';

      $user->save();

      return Redirect::to('/dashboard')->with('message', trans('c.Your account have been created.'))->withInput();
    } else {
      return Redirect::to('/user/create')->with('error', trans('c.Password confirmation doesnt match Password.'))->withInput();
    }
  }

  public function showNotifs()
  {

    if (Auth::check()) {
      $notifications = auth()->user()->unreadNotifications;
      return view('user/notifications', compact('notifications'));
    } else {
      return Redirect::intended('/');
    }
  }

  public function markNotification(Request $request)
  {
    auth()->user()
      ->unreadNotifications
      ->when($request->input('id'), function ($query) use ($request) {
        return $query->where('id', $request->input('id'));
      })
      ->markAsRead();

    return response()->noContent();
  }

  public function edit()
  {
    $id = Auth::user()->id;

    if ($this->isPostRequest()) {

      if (Auth::user()->email == 'xyusertest@gmail.com') {
        return Redirect::route('index')
          ->with('message', 'You are not allowed to change Test account. Plese create own registration. Thank you! ');
      } else if (Input::get('onlycurrency') == 1) {
        $user = \App\Models\User::find($id);
        $user->currency_id = Input::get('currency_id');
        $user->save();
      } else {

        $data = Input::all();

        $validator = Validator::make($data, array('name' => 'unique:users'));

        $validator = Validator::make($data, array('name' => 'required'));

        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', trans('c.The Username is empty!'))->withInput();
        }

        $validator = Validator::make($data, array('email' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', trans('c.The Email is empty!'))->withInput();
        }

        $validator = Validator::make($data, array('country' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'country is empty')->withInput();
        }
        $validator = Validator::make($data, array('country' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'country is empty')->withInput();
        }

        $validator = Validator::make($data, array('city' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'city is empty')->withInput();
        }

        $validator = Validator::make($data, array('ACC_NUM' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'ACC_NUM is empty')->withInput();
        }

        $validator = Validator::make($data, array('province' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'province is empty')->withInput();
        }

        $validator = Validator::make($data, array('phone_number' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'phone_number is required')->withInput();
        }

        $validator = Validator::make($data, array('pharma_address' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'pharma_address is required')->withInput();
        }


        $validator = Validator::make($data, array('postal_code' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', 'postal_code is empty')->withInput();
        }

        $validator = Validator::make($data, array('email' => 'email'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', trans('c.The Email address is not valid!'))->withInput();
        }

        $validator = Validator::make($data, array('password' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', trans('c.The Password is empty!'))->withInput();
        }

        $validator = Validator::make($data, array('password_confirmation' => 'required'));
        if ($validator->fails()) {
          return Redirect::to('/user/edit')->with('error', trans('c.The Password confirmation is empty!'))->withInput();
        }

        if (Input::get('password') == Input::get('password_confirmation')) {

          $user = \App\Models\User::find($id);

          $user->name = Input::get('name');
          $user->ACC_NUM = Input::get('ACC_NUM');
          $user->city = Input::get('city');
          $user->country = Input::get('country');
          $user->postal_code = Input::get('postal_code');
          $user->province = Input::get('province');
          $user->phone_number = Input::get('phone_number');
          $user->pharma_address = Input::get('pharma_address');
          $user->email = Input::get('email');

          $user->password = Input::get('password');
          $user->currency_id = Input::get('currency_id');
          $user->save();

          return Redirect::route('/dashboard')
            ->with('message', 'The user data has been changed successfully.');
        } else {
          return Redirect::to('/user/edit')->with('error', trans('c.Password confirmation doesnt match Password.'))->withInput();
        }
      }
    }



    $currency_list = \App\Models\Currency::orderBy('code')->get()->pluck('CurrencyFullName', 'id');



    return \View::make('user/useredit', array('currency_list' => $currency_list))->with('user', \App\Models\User::find($id));
  }

  protected function isPostRequest()
  {
    return Input::server("REQUEST_METHOD") == "POST";
  }

  public function test()
  {

    $laravel = app();
    echo $version = $laravel::VERSION;
  }
}
