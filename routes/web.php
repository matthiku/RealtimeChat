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

Route::get('/',                 'ChatController@chat');
Route::get('/home',             'ChatController@chat');
Route::post('/send',            'ChatController@send');
Route::post('/saveToSession',   'ChatController@saveToSession');
Route::post('/getOldMessages',  'ChatController@getOldMessages');
Route::post('/forgetChat',      'ChatController@forgetChat');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
