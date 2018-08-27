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

    // Route::get('/medicine/{user}', 'MedicineController@index');
    Route::get('/medicine/user', 'MedicineController@getMedicineByQuery');
    Route::post('/medicine/user', 'MedicineController@createByUser');

    // Route::get('/user/{user}/notification/{medicine}', 'NotificationController@getNotificationsByMedicine');
    Route::get('/notification/user', 'NotificationController@getNotifications');
    Route::post('/notification/user', 'NotificationController@addNotification');
    Route::delete('/notification/user/{notification}', 'NotificationController@deleteNotification');

    Route::get('/contact/user/', 'ContactController@index');
    Route::post('/contact/user/', 'ContactController@store');
    Route::put('/contact/user/{contact}', 'ContactController@update');
    Route::delete('/contact/user/{contact}', 'ContactController@destroy');

    Route::get('/usage/user', 'UsageController@getUsages');
    Route::post('/usage/user', 'UsageController@createUsage');
    Route::put('/usage/user/{usage}', 'UsageController@updateUsage');
    Route::delete('/usage/user/{usage}', 'UsageController@deleteUsage');

    Route::post('/admin/medicine/file','MedicineController@importFile');

});


