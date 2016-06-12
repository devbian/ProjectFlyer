<?php

Route::get('/', function () {
    return view('pages.home');
});

Route::resource('/flyers', 'FlyersController');
Route::get('/flyers/{zip}/{street}','FlyersController@show');
