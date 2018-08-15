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



// Route::get('/user/{user}/notification/{medicine}', 'NotificationController@getNotificationsByMedicine');
// Route::get('/user/{user}/notification', 'NotificationController@getNotifications');
// Route::post('/user/{user}/notification/{medicine}', 'NotificationController@addNotification');
// Route::delete('/user/notification/{noti}', 'NotificationController@deleteNotification');

// Route::get('/user/{user}/history', 'UsageController@getUsages');
// Route::post('/user/{user}/history', 'UsageController@createUsage');
// Route::post('/history/{history}/', 'UsageController@updateUsage');
// Route::delete('/history/{history}/', 'UsageController@deleteUsage');

// Route::get('/medicine/{user}', 'MedicineController@index');
// Route::get('/medicine/search/{user}/query', 'MedicineController@getMedicineByQuery');
// Route::post('/medicine/user/{user}', 'MedicineController@createByUser');

// Route::resource('/contact', 'ContactController');

// Route::get('/contact/user/{user}', 'ContactController@index');
// Route::post('/contact/user/{user}', 'ContactController@store');
// Route::post('/contact/{contact}', 'ContactController@update');
// Route::resource('/medicine', 'MedicineController');

