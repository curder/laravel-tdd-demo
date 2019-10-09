<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'],function () {
    Route::resource('carousel', 'CarouselController');
});
