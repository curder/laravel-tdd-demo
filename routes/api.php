<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::post('posts', 'PostsController@store')->name('posts.store'); // 保存文章
});
