<?php

namespace App\Http\Controllers\pages;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SsoClientAppServices;
use App\Services\UserServices;
use Exception;
use Illuminate\Http\Request;

class HomePage extends Controller
{
  private $ssoClientAppService;
  private $userService;
  public function __construct()
  {
    $this->ssoClientAppService = new SsoClientAppServices();
    $this->userService = new UserServices();
  }
  public function index()
  {
    Helpers::authPermission('Dashboard.View');
    $total_user = 0;
    $total_user_internal = 0;
    $total_user_eksternal = 0;
    $total_user_inactive = 0;

    $dataSsoClientApp = [];

    try {
      // Get User

      $allUser = $this->userService->getUserAll();
      $total_user = $allUser->count();
      $total_user_internal = $allUser
        ->where('is_active', '1')
        ->where('is_external_account', '0')
        ->count();
      $total_user_eksternal = $allUser
        ->where('is_active', '1')
        ->where('is_external_account', '1')
        ->count();
      $total_user_inactive = $allUser->where('is_active', '0')->count();

      //   //code...
      $dataSsoClientApp = $this->ssoClientAppService->getAll();
    } catch (Exception $e) {
      //throw $th;
      throw new Exception('Terjadi Kesalahan saat mengambil Data');
    }

    $calculate_user = [
      'total_user' => $total_user,
      'total_user_internal' => $total_user_internal,
      'total_user_eksternal' => $total_user_eksternal,
      'total_user_inactive' => $total_user_inactive,
    ];

    return view('content.pages.pages-home', compact('dataSsoClientApp', 'calculate_user'));
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
