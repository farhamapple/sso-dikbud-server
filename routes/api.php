<?php

use App\Http\Controllers\authentications\AuthController;
use App\Http\Controllers\pages\HomePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['prefix' => 'auth',],function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('user/me', [AuthController::class, 'getProfileMe']);
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('auth:api')->group(function () {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::post('me', [AuthController::class, 'getProfileMe']);
    });
  }
);
