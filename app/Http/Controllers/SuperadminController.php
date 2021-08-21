<?php


namespace App\Http\Controllers;

class SuperadminController extends Controller
{
  public function index()
  {

    return \View::make('superadmin/index');
  }

  public function userList()
  {
    $users = \App\Models\User::all();

    return \View::make('superadmin/userlist')->with(array('users' => $users));
  }


  public function deleteLog()
  {
    $users = \App\Models\User::all();

    File::delete(public_path() . '/app/storage/logs/laravel.log');

    return Redirect::to('superadmin')->with('message', 'Log deleted.');
  }
}
