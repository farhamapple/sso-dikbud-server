<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SsoClientAppServices;
use Illuminate\Http\Request;

class HomePage extends Controller
{
  private $ssoClientApp;
  public function __construct()
  {
    $this->ssoClientApp = new SsoClientAppServices();
  }
  public function index()
  {
    try {
      //code...
      $dataSsoClientApp = $this->ssoClientApp->getAll();
    } catch (\Throwable $th) {
      //throw $th;
    }
    return view('content.pages.pages-home', compact('dataSsoClientApp'));
  }
  public function me(Request $request)
  {
    $emal = $request->email;

    $data_user = User::where('email', $emal)->get();

    return response()->json(
      [
        'status' => 'OK',
        'data' => $data_user,
      ],
      200
    );
  }
}
