<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\OauthClientModel;
use Illuminate\Http\Request;

class OauthClientPage extends Controller
{
  //
  public function index()
  {
    $oauthClientData = OauthClientModel::all();
    // dd($oauthClientData);
    return view('content.pages.pages-oauth-client', compact('oauthClientData'));
  }
}
