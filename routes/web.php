<?php

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
Route::match(['post','get'], 'changePassword', 'UserController@changePassword');

Route::match(['post','get'], 'changePasswordToken', 'UserController@changePasswordToken');

Route::get('/', function () {
    return view('home');
});

Route::get('contactus', function () {
    return view('contactus');
});

Route::get('terms', function () {
    return view('terms');
});

 

Route::get('about-us', function () {
      echo "about-us";
});


Route::get('privacy-policy', function () {
      echo "privacy-policy";
});


Route::get('terms-and-conditions', function () {
      echo "terms-and-conditions";
});


Route::get('legality', function () {
      echo "legality";
});


Route::get('how-to-play', function () {
      echo "how-to-play";
});

 