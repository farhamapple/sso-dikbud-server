<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
  //
  public function register(Request $request)
  {
    // $request->validate([
    //   'name' => 'required|string',
    //   'email' => 'required|string|email|unique:users',
    //   'password' => 'required|string|',
    //   'c_password' => 'required|same:password',
    // ]);
    // dd($request);

    $user = new User([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    if ($user->save()) {
      return response()->json(
        [
          'message' => 'Successfully created user!',
        ],
        201
      );
    } else {
      return response()->json(['error' => 'Provide proper details']);
    }
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);

    $credentials = request(['email', 'password']);
    if (!Auth::attempt($credentials)) {
      return response()->json(
        [
          'message' => 'Unauthorized',
        ],
        401
      );
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
        'data' => $user,
        'access_token' => $tokenResult->accessToken,
        'token_type' => 'Bearer',
        'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
      ],
      200
    );
  }
}
