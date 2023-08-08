<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginBasic extends Controller
{
  private $userService;

  public function __construct()
  {
    $this->userService = new UserServices();
  }

  public function index(Request $request)
  {
    if (isset(parse_url(url()->previous())['query'])) {
      parse_str(parse_url(url()->previous())['query'], $params);
      $redirect_uri = $params['redirect_uri'];
      if ($redirect_uri != '') {
        session(['link' => $redirect_uri]);
      }
    }
    // die(redirect()->getUrlGenerator()->previous());
    // session(['link' => url()->previous()]);
    // Cek
    if (Auth::check()) {
      // Home

      return redirect(route('pages-home'));
    } else {
      $pageConfigs = ['myLayout' => 'blank'];
      return view('content.authentications.auth-login-basic', [
        'pageConfigs' => $pageConfigs,
        'from' => session('link'),
      ]);
    }
  }

  public function store(Request $request)
  {
    $request->validate([
      'username' => 'required|string',
      'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');

    //  dd(bcrypt('Admin123'));
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

        if (session('link') != '') {
          return redirect(session('link'));
        } else {
          return redirect('/home');
        }
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

  function forgot_password_send_link(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'username' => 'required|string|',
    ]);

    $userData = User::where('email', $request->email)
      ->where('username', $request->username)
      ->first();
    $userData->activation_code = Str::uuid();
    $userData->updated_at = Carbon::now()->toDateTimeString();
    $userData->save();

    if ($userData == null) {
      return redirect(route('auth-forgot-password'))->with([
        'error' => 'Email or Username Not Provide / Email atau Username tidak ada',
      ]);
    }

    // Send Reset Link by Email
    Mail::to($userData->email)->send(new NotificationEmail($userData));

    return redirect(route('auth-login-basic'))->with([
      'success' =>
        'Please check your email, to Reset Password link <br> Silahkan check Email untuk Link Reset Password',
    ]);
  }

  function forgot_password_form($activation_code)
  {
    // check ref in User
    $userData = User::where('activation_code', $activation_code)->first();
    if ($userData == null) {
      return redirect(route('auth-forgot-password'))->with([
        'error' => 'Reset Password Link is Wrong / Link Reset Password Salah',
      ]);
    }

    // Go to Forgot Password Form
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-forgot-password-form', [
      'pageConfigs' => $pageConfigs,
      'email' => $userData->email,
      'activation_code' => $userData->activation_code,
    ]);
  }

  function forgot_password_store(Request $request)
  {
    // Action to reset password
    $request->validate([
      'password' => 'required|string',
      'confirm_password' => 'required|string',
    ]);

    if ($request->password != $request->confirm_password) {
      //dd('gagal');
      return redirect(route('auth-forgot-password-form', $request->ref))->with([
        'error' => 'Password not Match / Password tidak sama',
      ]);
    } else {
      //dd('berhasil');
      $userData = User::where('activation_code', $request->activation_code)->first();
      $userData->password = bcrypt($request->password);
      $userData->updated_at = Carbon::now()->toDateTimeString();
      $userData->updated_by = $userData->email;
      $userData->save();

      return redirect(route('auth-login-basic'))->with([
        'success' => 'Success Reset Password <br> Berhasil melakukan Reset Password',
      ]);
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
