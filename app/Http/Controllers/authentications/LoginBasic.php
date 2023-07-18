<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginBasic extends Controller
{
  public function index()
  {
    // Cek
    if (Auth::check()) {
      // Home
      return redirect(route('pages-home'));
    } else {
      $pageConfigs = ['myLayout' => 'blank'];
      return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
    }
  }

  public function store(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');
    //dd(Auth::attempt($credentials));
    if (Auth::attempt($credentials)) {
      // Authentication passed...
      // Get Data User
      $user = $request->user();
      // dd($user->is_active);
      if ($user->is_active == '0') {
        Auth::logout();
        $request->session()->invalidate();

        return redirect(route('auth-login-basic'))->with(['error' => 'User is Not Active, Please check your email']);
      } else {
        // Create Personal Akses Token
        $personal_akses_token = $user->name . ' | PAT - WEB SSO Server';
        $tokenResult = $user->createToken($personal_akses_token);
        $token = $tokenResult->token;

        if ($request->remember_me) {
          $token->expires_at = Carbon::now()->addWeeks(1);
        }

        $token->save();

        return redirect(route('pages-home'));
      }

      // go To Dashboard
    } else {
      // Redirect Halaman Lolgin
      return redirect(route('auth-login-basic'))->with(['error' => 'Email or Password Wrong']);
    }
  }

  function forgot_password()
  {
    // Cek
    if (Auth::check()) {
      // Home
      return redirect(route('pages-home'));
    } else {
      $pageConfigs = ['myLayout' => 'blank'];
      return view('content.authentications.auth-forgot-password', ['pageConfigs' => $pageConfigs]);
    }
  }

  function forgot_password_store(Request $request)
  {
  }

  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
