<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

      // Create Personal Akses Token
      $personal_akses_token = $user->name . ' | PAT - WEB SSO Server';
      $tokenResult = $user->createToken($personal_akses_token);
      $token = $tokenResult->token;

      if ($request->remember_me) {
        $token->expires_at = Carbon::now()->addWeeks(1);
      }

      $token->save();

      return redirect(route('pages-home'));
      // go To Dashboard
    } else {
      // Redirect Halaman Lolgin
      return back()
        ->withErrors([
          'email' => 'The provided credentials do not match our records.',
        ])
        ->onlyInput('email');
    }
  }

  public function logout(Request $request): RedirectResponse
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
