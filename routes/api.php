<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::get('posts', 'PostsController@index')->name('posts.index'); // 文章列表
    Route::patch('posts/{post}', 'PostsController@update')->name('posts.update'); // 更新文章
    Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy'); // 删除文章
    Route::post('posts', 'PostsController@store')->name('posts.store'); // 保存文章
});
