<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-register-basic', ['pageConfigs' => $pageConfigs]);
  }

  public function store(Request $request)
  {
    // $request->validate([
    //   'first_name' => ['req],
    //   'phone' => 'required|number|max:15',
    //   'email' => 'required|string|email|unique:email|max:255',
    //   'password' => 'required|string|max:255',
    // ]);

    $validator = Validator::make($request->all(), [
      'first_name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'numeric'],
      'email' => ['required', 'string', 'max:255', 'unique:users,email'],
      'username' => ['required', 'string', 'max:255', 'unique:users,username'],
      'password' => ['required', 'string', 'max:255'],
    ]);

    if ($validator->fails()) {
      return redirect(route('auth-register-basic'))
        ->withErrors($validator)
        ->withInput();
    }

    // Retrieve the validated input...
    $validated = $validator->validated();

    $userInsert = new User();
    $userInsert->first_name = $validated['first_name'];
    $userInsert->last_name = $request->last_name;
    $userInsert->name = $validated['first_name'] . ' ' . $request->last_name;
    $userInsert->password = bcrypt($validated['password']);
    $userInsert->email = $validated['email'];
    $userInsert->phone = $validated['phone'];
    $userInsert->email_external = $validated['email'];
    $userInsert->username = $validated['username'] ? $validated['username'] :$validated['email'];
    $userInsert->is_active = '1';
    $userInsert->is_external_account = '1';
    $userInsert->role_id = '1';
    $userInsert->ref = Str::uuid();
    $userInsert->is_asn = $request->is_asn;
    $userInsert->activation_code = Str::uuid();
    $userInsert->created_by = $validated['email'];
    $userInsert->updated_by = $validated['email'];
    $userInsert->save();

    // Send Email for Activation

    return redirect(route('auth-register-basic'))->with(
      'success',
      'Congratulation! Check Email Soon to Verified Account <br> Selamat!, Anda berhasil membuat Akun SSO, segera Cek Email untuk Aktivasi'
    );
  }

  function register_activation($activation_code)
  {
    // Cek Validation Code
    $pageConfigs = ['myLayout' => 'blank'];
    $userData = User::where('activation_code', $activation_code)->first();
    //dd($userData);
    if ($userData == null) {
      return view('content.authentications.auth-register-activation', [
        'pageConfigs' => $pageConfigs,
        'success' => null,
        'error' => 'Link Activation Wrong<br>Link Activasi Salah',
      ]);
    } else {
      $userData->is_active = '1';
      $userData->email_verified_at = Carbon::now()->toDateTimeString();
      $userData->updated_at = Carbon::now()->toDateTimeString();
      $userData->updated_by = $userData->email;
      $userData->save();
      return view('content.authentications.auth-register-activation', [
        'pageConfigs' => $pageConfigs,
        'error' => null,
        'success' => 'Congratulation, Your account has Activated<br>Selamat, Akun anda berhasil ter-aktivasi',
      ]);
    }
  }
}
