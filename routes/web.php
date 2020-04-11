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
    '/{name}',
    [
        'as'   => 'contentspage',
        'uses' => 'HomeController@getPage',
    ]
);
 