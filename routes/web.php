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
    return view('welcome');
});

Route::post('/user/login','AuthController@login');
Route::post('/user/login/{user}','AuthController@loginById');
Route::post('/user/update/{user}','UserController@update');
Route::post('/user/register/','UserController@register');

Route::get('/user/{user}/notification/{medicine}', 'UserController@getNotificationsByMedicine');
Route::get('/user/{user}/notification', 'UserController@getNotifications');
Route::post('/user/{user}/notification/{medicine}', 'UserController@addNotification');
Route::delete('/user/notification/{noti}','UserController@deleteNotification');

Route::get('/user/{user}/history','UserController@getUsages');
Route::post('/user/{user}/history','UserController@createUsage');
Route::post('/history/{history}/','UserController@updateUsage');
Route::delete('/history/{history}/','UserController@deleteUsage');

Route::get('/medicine/{user}', 'MedicineController@index');
Route::get('/medicine/search/{user}/query', 'MedicineController@getMedicineByQuery');
Route::post('/medicine/user/{user}', 'MedicineController@createByUser');

Route::resource('/contact', 'ContactController');

Route::get('/contact/user/{user}','ContactController@index');
Route::post('/contact/user/{user}','ContactController@store');
Route::post('/contact/{contact}','ContactController@update');

Route::resource('/medicine', 'MedicineController');

