<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
  //
  public function register(Request $request)
  {
    //define validation rules
    $validator = Validator::make($request->all(), [
        'name'     => 'required',
        'email'    => 'required | email | unique:users,email',
        'password'   => 'required|min:6',
        'password_confirmation' => 'required_with:password|same:password|min:6',
    ], [
      'email.unique' => 'User with this email already exists',
    ]);
    if ($validator->fails()) {
      return response()->json([
        'code' => 422,
        'message' => 'Invalid params passed', // the ,message you want to show
          'errors' => $validator->errors()
      ], 422);
    }
    $user = new User([
      'name' => $request->name,
      'email' => $request->email,
      'username' => $request->email,
      'password' => bcrypt($request->password),
    ]);
    if ($user->save()) {
      return response()->json(
      [
        'code' => 200,
        'message' => 'Successfully created user!',
        'data' => $user,
      ],200);
    } else {
      return response()->json([
        'code' => 400,
        'message' => 'Terjadi kesalahan',
        'result' => []
      ], 400);
    }
  }
  public function login(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
          'username'    => 'required',
          'password'   => 'required|min:6',
      ]);
      if ($validator->fails()) {
        return response()->json([
          'code' => 422,
          'message' => 'Invalid params passed', // the ,message you want to show
            'errors' => $validator->errors()
        ], 422);
      }
        $credentials = request(['username', 'password']);
        if (!Auth::attempt($credentials)) {
          return response()->json(
            [
              'message' => 'Unauthorized',
            ],401);
        }

        $user = $request->user();
        $personal_akses_token = $user->name . ' | PAT - From Client';
        $tokenResult = $user->createToken($personal_akses_token);
        $token = $tokenResult->token;

        if ($request->remember_me) {
          $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json(
          [
            'code' => 200,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'data' => $user,
          ],200);
      }catch (\Exception $e) {
      return response()->json([
        'code' => 400,
          'message' => 'Terjadi kesalahan : '.json_encode($e),
          'result' => []
        ], 400);
    }
  }
  public function getProfileMe(Request $request){
      try {
        $accessToken = $request->header('Authorization');
        $accessToken = str_replace('Bearer ', '', $accessToken);
        $user = Auth::guard('api')->user();
        $return_data = array();
        $return_data["user_data"] = $user;
        $return_data["pegawai_data"] = null;
        $data['code'] = 200;
        $data['success'] = true;
        $data['message'] = 'sukses';
        $data['data'] = $return_data;

        return response()->json($data, 200);
      }catch (\Exception $e) {
      return response()->json([
          'code' => 400,
          'message' => 'Terjadi kesalahan : '.json_encode($e),
          'result' => []
        ], 404);
    }
  }
  
}


