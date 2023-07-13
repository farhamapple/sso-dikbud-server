<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomePage extends Controller
{
  public function index()
  {
    return view('content.pages.pages-home');
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
