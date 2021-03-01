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
    Route::get('shop/top', 'Admin\Shopcontroller@add')->middleware('auth'); 
    Route::post('shop/create', 'Admin\Shopcontroller@create'); 
    Route::get('shop/update', 'Admin\Shopcontroller@update');
    Route::post('news/edit', 'Admin\Shopcontroller@update')->middleware('auth');
    Route::get('news/delete', 'Admin\Shopcontroller@delete')->middleware('auth');
    Route::get('news', 'Admin\Shopcontroller@index')->middleware('auth'); 

    Route::get('profile/create', 'Admin\Cafeshop@add')->middleware('auth');
    Route::post('profile/create', 'Admin\Cafeshop@create')->middleware('auth');
    Route::get('profile/edit', 'Admin\Cafeshop@edit')->middleware('auth');
    Route::post('profile/edit', 'Admin\Cafeshop@update')->middleware('auth');
    Route::get('profile/delete', 'Admin\Cafeshop@delete')->middleware('auth');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
