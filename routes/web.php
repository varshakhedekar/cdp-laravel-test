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
    return view('customers.welcome');
});

Auth::routes();

Route::group(['namespace' => 'Customers', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/products', 'ProductController@productsView')->name('products');
    Route::get('products/pagination', 'ProductController@fetchProductsData');

});
