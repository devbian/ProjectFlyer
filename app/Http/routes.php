<?php

Route::get('/', function () {
    return view('pages.home');
});

Route::post('/{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'FlyersController@addPhoto']);
Route::get('/{zip}/{street}', 'FlyersController@show');
Route::resource('/flyers', 'FlyersController');
