<?php

//LOGIN REGISTER ROUTES

Auth::routes();

//ADMIN ROUTES

Route::get('/admin/products/create', 'ProductsController@create');
Route::get('/admin/products/{product}', 'ProductsController@show');
Route::get('/admin/products/edit/{product}', 'ProductsController@edit');
Route::patch('/admin/products/update/{product}', 'ProductsController@update');
Route::delete('/admin/products/destroy/{product}', 'ProductsController@destroy');
Route::get('/admin', 'ProductsController@index');
Route::post('/admin', 'ProductsController@store');

//Route::resource('products', 'ProductsController');

//PUBLIC ROUTES

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

