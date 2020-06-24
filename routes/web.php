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

Route::get('chart-line', 'ChartController@chartLine');
Route::get('chart-line-ajax', 'ChartController@chartLineAjax');
Route::get('charts', 'ChartController@index');

if (App::environment('prod')) {
    \URL::forceScheme('https');
}

Route::match(['post','get'], 'changePassword', 'UserController@changePassword');

Route::match(['post','get'], 'changePasswordToken', 'UserController@changePasswordToken');

Route::match(['post','get'], '/', 'HomeController@home');
Route::match(['post','get'], '404', 'HomeController@page404');


Route::match(
    ['post','get'],
    '/contactus',
    [
        'as'   => 'contactus',
        'uses' => 'HomeController@contactus',
    ]
);



Route::match(
    ['post','get'],
    '/aboutus',
    [
        'as'   => 'aboutus',
        'uses' => 'HomeController@aboutus',
    ]
);

Route::match(
    ['post','get'],
    '/{name}',
    [
        'as'   => 'contentspage',
        'uses' => 'HomeController@getPage',
    ]
);

