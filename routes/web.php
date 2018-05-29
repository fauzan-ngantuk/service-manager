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

Route::get('/', function () {
    return redirect('/token');
});

Route::resource('/users', 'UsersController');
Route::resource('/application', 'ApplicationController');
Route::resource('/function', 'FunctionController');
Route::get('/token', 'TokenController@index')->name('token.index');
Route::get('/token/{id}', 'TokenController@show')->name('token.setting');
Route::delete('/token/{id}', 'TokenController@destroy')->name('token.delete');
Route::post('/functiontoken', 'TokenController@setFunction')->name('token.setfunction');
