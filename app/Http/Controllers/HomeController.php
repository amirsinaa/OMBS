<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('home');
  }

  public function langtest()
  {

    $array = $this->importFile();

    return \View::make('home/langtest', array('langarr' => $array));
  }

  function importFile()
  {
    return  require base_path('resources') . '/lang/_etalon/c.php';
  }
}
