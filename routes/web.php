<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('signup', function(){
    return view('auth.signup');
})->name('signup');
Route::get('login', function(){
    return view('welcome');
})->name('login');
Route::get('otp-verification', function(){
    return view('auth.otp_verification');
})->name('otp_verification');

Route::get('home', [HomeController::class, 'home'])->name('home');
Route::post('/user_login', [HomeController::class, 'userLogin'])->name('user_login');
Route::post('/user_signup', [HomeController::class, 'userSignup'])->name('user_signup');
Route::get('/user_availability_checker_signup', [HomeController::class, 'userAvailabilityCheckerSignup'])->name('user_availability_checker_signup');
Route::post('/verify_otp', [HomeController::class, 'verifyOtp'])->name('verify_otp');

Route::group(['middleware' => 'Is_User'], function () {
    Route::get('web_dashboard', [HomeController::class, 'home'])->name('web_dashboard');
    Route::post('booking', [HomeController::class, 'booking'])->name('booking');
    Route::post('user_logout', [HomeController::class, 'userLogout'])->name('user_logout');
});
