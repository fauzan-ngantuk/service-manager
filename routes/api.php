<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/token', 'Api\RequestTokenAPIController@requestToken');
Route::post('/auth', 'Api\CheckTokenAPIController@authToken');
Route::post('/check', 'Api\CheckTokenAPIController@checkToken');
Route::post('/dev/func_request', 'Api\DevRequestFunctionAPIController@requestFunction');
