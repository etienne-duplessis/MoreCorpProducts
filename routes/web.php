<?php

//LOGIN REGISTER ROUTES

Auth::routes();

//ADMIN ROUTES

Route::get('/admin/products/create', 'AdminController@create');
Route::get('/admin/products/{product}', 'AdminController@show');
Route::get('/admin/products/edit/{product}', 'AdminController@edit');
Route::patch('/admin/products/update/{product}', 'AdminController@update');
Route::delete('/admin/products/destroy/{product}', 'AdminController@destroy');
Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@store');

//Route::resource('products', 'AdminController');

//PUBLIC ROUTES

Route::post('/public/products/create', 'PublicController@create');
Route::get('/public/products/{product}', 'PublicController@show');
Route::post('/', 'PublicController@store');
Route::get('/home', 'PublicController@index')->name('home');
Route::get('/', 'PublicController@index')->name('home');

