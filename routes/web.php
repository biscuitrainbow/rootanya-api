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

Route::get('/user/{user}/notification/{medicine}', 'UserController@getNotificationsByMedicine');
Route::get('/user/{user}/notification', 'UserController@getNotifications');
Route::post('/user/{user}/notification/{medicine}', 'UserController@addNotification');

Route::get('/user/{user}/usages','UserController@getUsages');
Route::post('/user/{user}/usage','UserController@createUsage');

Route::get('/medicine', 'MedicineController@index');
Route::get('/medicine/query', 'MedicineController@getMedicineByQuery');
Route::post('/medicine/user/{user}', 'MedicineController@createByUser');

Route::resource('/contact', 'ContactController');

Route::get('/contact/user/{user}','ContactController@index');
Route::post('/contact/user/{user}','ContactController@store');
Route::post('/contact/{contact}','ContactController@update');

Route::resource('/medicine', 'MedicineController');

