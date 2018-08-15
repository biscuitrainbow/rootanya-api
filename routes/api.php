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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/user/login', 'AuthController@login');
Route::post('/user/login/{user}', 'AuthController@loginById');
Route::post('/user/register/', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', 'UserController@detail');
    Route::put('/user', 'UserController@update');
    Route::post('/logout', 'AuthController@logout');

});


