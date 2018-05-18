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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/admin', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');

Route::get('/admin/create', 'ProductsController@create');
Route::get('/admin/{product}', 'ProductsController@show');
Route::get('/admin/edit/{product}', 'ProductsController@edit');
Route::patch('/admin/update/{product}', 'ProductsController@update');
Route::patch('/admin/destroy/{product}', 'ProductsController@destroy');
Route::get('/admin', 'ProductsController@index');
Route::post('/admin', 'ProductsController@store');

//Route::resource('products', 'ProductsController');

