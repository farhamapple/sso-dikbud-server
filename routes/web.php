<?php

use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\ProfilePage;
use App\Http\Controllers\UserController;
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
        Route::get('/user-show-all', [UserController::class, 'showAll'])->name('user-show-all');
      }
    );
  }
);

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::post('auth/login-post', $controller_path . '\authentications\LoginBasic@store')->name('auth-login-store');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name(
  'auth-register-basic'
);
Route::post('auth/register-store', $controller_path . '\authentications\RegisterBasic@store')->name(
  'auth-register-store'
);
