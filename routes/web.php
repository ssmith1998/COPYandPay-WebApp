<?php

use Illuminate\Support\Facades\Route;


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
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::post('/register/user/', 'RegisterController@register')->name('registerUser');
Route::post('/login/user/', 'LoginController@Login')->name('loginUser');
Route::get('/logout', 'LoginController@Logout')->name('logout');
Route::post('/copyandpay/setup', 'ApiController@getDetails')->middleware('auth');
Route::get('/paymentSuccess/', 'ApiController@paymentSuccess')->name('paymentSuccess')->middleware('auth');
Route::get('/refund', 'ApiController@refund')->name('refund')->middleware('auth');
