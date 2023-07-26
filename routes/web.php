<?php

use App\Http\Controllers\authentications\AuthController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\OauthClientPage;
use App\Http\Controllers\pages\ProfilePage;
use App\Http\Controllers\pages\UserPage;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

$controller_path = 'App\Http\Controllers';
Route::get('/login', $controller_path . '\authentications\LoginBasic@index')->name('login');
// Main Page Route
Route::get('/', $controller_path . '\pages\LandingPage@index')->name('pages-landing');
// After Login
Route::group(
  [
    'middleware' => 'auth',
  ],
  function () {
    // Role Guest
    Route::get('/home', [HomePage::class, 'index'])->name('pages-home');
    Route::get('/profile/{id}', [ProfilePage::class, 'index'])->name('pages-profile');
    // Logout
    Route::post('/logout', [LoginBasic::class, 'logout'])->name('logout');
    // Route Middleware for ADMIN
    Route::group(
      [
        'middleware' => 'admin',
      ],
      function () {
        Route::get('/user/user-show-all', [UserController::class, 'showAll'])->name('user-show-all');
        Route::get('/user/user-show/{is_external_account}', [UserPage::class, 'index'])->name('pages-user-show');
        Route::get('/user/user-inactive', [UserPage::class, 'user_inactive'])->name('pages-user-inactive');
        Route::get('/oauth-client', [OauthClientPage::class, 'index'])->name('oauth-client.index');
      }
    );
  }
);
// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// Login
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::post('/auth/login-post', $controller_path . '\authentications\LoginBasic@store')->name('auth-login-store');
Route::get('/auth/forgot-password', $controller_path . '\authentications\LoginBasic@forgot_password')->name(
  'auth-forgot-password'
);

Route::post(
  '/auth/forgot-password-send-link',
  $controller_path . '\authentications\LoginBasic@forgot_password_send_link'
)->name('auth-forgot-password-send-link');

Route::get(
  '/auth/forgot-password-form/{ref}',
  $controller_path . '\authentications\LoginBasic@forgot_password_form'
)->name('auth-forgot-password-form');

Route::post(
  '/auth/forgot-password-store',
  $controller_path . '\authentications\LoginBasic@forgot_password_store'
)->name('auth-forgot-password-store');

// Register
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name(
  'auth-register-basic'
);
Route::post('auth/register-store', $controller_path . '\authentications\RegisterBasic@store')->name(
  'auth-register-store'
);

Route::get(
  'auth/register-activation/{activation_code}',
  $controller_path . '\authentications\RegisterBasic@register_activation'
)->name('auth-register-activation');

Route::get('/callback', function (Request $request) {
  $http = new GuzzleHttp\Client;

  $response = $http->post('http://your-app.com/oauth/token', [
      'form_params' => [
          'grant_type' => 'authorization_code',
          'client_id' => 'client-id',
          'client_secret' => 'client-secret',
          'redirect_uri' => 'http://example.com/callback',
          'code' => $request->code,
      ],
  ]);

  return json_decode((string) $response->getBody(), true);
});
Route::get('/oauth/callback', [AuthController::class, 'oauthCallback']);
