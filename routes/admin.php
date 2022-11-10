<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * Backend Routes
 */
Auth::routes();
Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {

    Route::post('upload', "UploadController@upload")->name('upload');

    Route::get('/', 'HomeController@login')->name('/');

    Route::resource('/products', 'ProductsController', ['except' => ['show']]);

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
    Route::get('/change-password', 'HomeController@changePassword')->name('setting.change-password');
    Route::post('/change-password-store', 'HomeController@changePasswordStore')->name('setting.change-password-store');
   
});
Route::get('/login', 'Admin\HomeController@login')->name('login');
Route::post('/loginLogs', 'Admin\LoginController@loginLogs')->name('loginLogs');

