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
    return view('welcome');
});
    
Route::group(['prefix' => 'admin'], function() {
    Route::get('shop/top', 'Admin\Shop@add')->middleware('auth'); 
    Route::post('shop/create', 'Admin\Shop@create'); 
    Route::get('shop/update', 'Admin\Shop@update');

    Route::get('shop/create', 'Admin\Cafeshop@add')->middleware('auth'); 
    Route::post('shop/create', 'Admin\Cafeshop@create'); 
    Route::get('shop/update', 'Admin\Cafeshop@edit'); 

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
