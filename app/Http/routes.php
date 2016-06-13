<?php

Route::get('/', 'HomeController@home');

// login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
// register
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::resource('/flyers', 'FlyersController');
Route::post('/{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'PhotosController@store']);
Route::get('/{zip}/{street}', 'FlyersController@show');

Route::delete('/photos/{id}', 'PhotosController@destory');


