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

Route::get('apkDownload',function(){
   //return redirect(url('public/upload/apk/sportsfight.apk'));
   $url = url('public/upload/apk/sportsfight.apk');
   return Response::download($url);
});

Route::get('apk',function(){
   //return \Response::download('public/upload/apk/sportsfight.apk'); 
  //  return redirect();
    $url = url('public/upload/apk/sportsfight.apk');
    return Response::download($url);
});


Route::get('liveChat','HomeController@liveChat');

if (App::environment('prod')) {
    \URL::forceScheme('https');
}

Route::match(['post','get'], 'changePassword', 'UserController@changePassword');

Route::match(['post','get'], 'changePasswordToken', 'UserController@changePasswordToken');

Route::match(['post','get'], '/', function(){
    echo "access deny";
});

