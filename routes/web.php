<?php

//LOGIN REGISTER ROUTES

Auth::routes();

//ADMIN ROUTES

Route::get('/admin/create', 'ProductsController@create');
Route::get('/admin/{product}', 'ProductsController@show');
Route::get('/admin/edit/{product}', 'ProductsController@edit');
Route::patch('/admin/update/{product}', 'ProductsController@update');
Route::delete('/admin/destroy/{product}', 'ProductsController@destroy');
Route::get('/admin', 'ProductsController@index');
Route::post('/admin', 'ProductsController@store');

//Route::resource('products', 'ProductsController');

//PUBLIC ROUTES

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

