<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserPage extends Controller
{
  //
  public function index($is_external_account)
  {
    $usersData = User::where('is_external_account', $is_external_account)
      ->where('is_active', '1')
      ->get();
    if ($is_external_account == '0') {
      $tipe_user = 'User Internal';
    } else {
      $tipe_user = 'User Eksternale';
    }

    return view('content.pages.users.pages-users', compact('usersData', 'tipe_user'));
  }

  public function user_inactive()
  {
    $usersData = User::where('is_active', '0')->get();
    $tipe_user = 'User Inactive';
    return view('content.pages.users.pages-users', compact('usersData', 'tipe_user'));
  }
}
