<?php

namespace App\Http\Controllers\authentications;

use App\Helpers\Helpers;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\Controller;
use App\Mail\NotificationEmail;
use App\Models\OauthAccessTokenModel;
use App\Models\SettingsModel;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use GuzzleHttp\Client as GuzzleHttpClient;

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
        $arrayParam = $request->session()->pull('client', []);
        if (isset($arrayParam["redirect_uri"]) && $arrayParam["redirect_uri"] != '') {
          return redirect($arrayParam["redirect_uri"]);
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
    $nomorWa = "";
    $userData = null;
    // cek data pegawai
    $sumber_api = SettingsModel::getData('endpoint.pegawai');
    if($sumber_api == "1"){
      $dataSiasn =  Helpers::getDataPegawai($request->username);
      $dataSiasn->data = $dataSiasn->data[0];
    }else{
      $dataSiasn = Helpers::getDataPegawaiSiasn($request->username);
      $dataSiasn->data->nip = $dataSiasn->data->nipBaru;
      $dataSiasn->data->tlp = $dataSiasn->data->noHp;
    }
    // dd($dataSiasn);
    if(isset($dataSiasn->data)){
      $username = $dataSiasn->data->nip;
      $email = $dataSiasn->data->email;
      $nomorWa = ($dataSiasn->data->tlp != "" && $dataSiasn->data->tlp != "0") ? $dataSiasn->data->tlp : "082260195526";
      if($username != $request->username && $email != $request->email){
        return redirect(route('auth-forgot-password'))->with([
          'error' => 'Username dan email tidak cocok',
        ]);
      }
      // cek ke tabel user
      $userData = User::where('username', $request->username)->first();
      // jika di tabel user blm ada, buatlah user baru
      if ($userData == null) {
        $userData = new User();
        $userData->first_name = $dataSiasn->data->nama;
        $userData->last_name = "";
        $userData->name = $dataSiasn->data->nama;
        $userData->username = $dataSiasn->data->nip;
        $userData->nip = $dataSiasn->data->nip;
        $userData->password = bcrypt("Data.12345New");
        $userData->email = $dataSiasn->data->email;
        $userData->phone = $nomorWa;
        $userData->email_external = $dataSiasn->data->email;
        $userData->is_active = '1';
        $userData->is_external_account = '1';
        $userData->role_id = '2';
        $userData->ref = Str::uuid();
        $userData->is_asn = "1";
        $userData->activation_code = Str::uuid();
        $userData->identity_number = $dataSiasn->data->nik;
        $userData->created_by = $dataSiasn->data->nip;
        $userData->created_at = Carbon::now()->toDateTimeString();
        $userData->created_by = $dataSiasn->data->nip;
        $userData->updated_by = $dataSiasn->data->nip;
        if($userData->save()){
          User::setDefaultRole($userData);
        }

      }else{
        $userData->nip = $dataSiasn->data[0]->nip;
        $userData->email = $dataSiasn->data[0]->email;
        $userData->phone = $dataSiasn->data[0]->tlp;
        $userData->email_external = $dataSiasn->data[0]->email;
        $userData->is_active = '1';
        $userData->updated_by = $dataSiasn->data[0]->nip;
      }
    }
    if(!$userData){
      $userData = User::where('email', $request->email)
      ->where('username', $request->username)
      ->first();
    }
    if ($userData == null) {
      return redirect(route('auth-forgot-password'))->with([
        'error' => 'Data Tidak ditemukan',
      ]);
    } else {
      $userData->activation_code = Str::uuid();
      $userData->updated_at = Carbon::now()->toDateTimeString();
      $userData->save();
      // Send Reset Link by Email
      // Mail::to($userData->email)->send(new NotificationEmail($userData));
      // send link by WA
      $message = "*Halo ".$userData->name."*, silahkan klik \n".route('auth-forgot-password-form', $userData->activation_code)." \nuntuk merubah password anda";
      // dd($message);
      $nomorWa = $nomorWa != "" ? $nomorWa : $userData->phone;
      if($nomorWa != ""){
        $dataOtp = AuthOtpController::generateOtp($userData);
        $message .= "\natau masukan token dengan ".$dataOtp->otp;
        $result = Helpers::sendNotif(true,false,$nomorWa,$message);
        // if(!$result){
        //   return redirect(route('auth-login-basic'))->with([
        //     'error' =>
        //       'Kirim gagal',
        //   ]);
        // }
        return redirect(route('otp.verification',$userData->ref))->with([
          'success' =>
            'Silahkan check Email untuk Link Reset Password atau silahkan masukan OTP yang telah dikirimkan ke WA',
        ]);
      }else{
        return redirect(route('auth-login-basic'))->with([
          'error' =>
            'User tidak ditemukan',
        ]);
      }
    }

    
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
      'ref' => $userData->ref,
    ]);
  }

  function forgot_password_store(Request $request)
  {
    // Action to reset password
    $request->validate([
      'activation_code' => 'required|string',
      'password' => 'required|string',
      'confirm_password' => 'required|string',
      'ref' => 'required|string',
    ]);

    if ($request->password != $request->confirm_password) {
      return redirect(route('auth-forgot-password-form', $request->activation_code))->with([
        'error' => 'Password not Match / Password tidak sama',
      ]);
    } else {
      $newUserData = $this->userService->changePassword($request->password, $request->activation_code);
      Auth::login($newUserData);
      redirect('/hoe');
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
