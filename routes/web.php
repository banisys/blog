<?php


Route::get('/', 'ArticleController@index')->middleware('auth');

Auth::routes();

Route::get('/article', 'ArticleController@index')->name('articles')->middleware('auth');
Route::get('/article/create', 'ArticleController@create')->middleware('auth');
Route::post('/article/store' , 'ArticleController@store')->name('article.store');
Route::get('/article/{article}' , 'ArticleController@show')->name('article.show');
Route::get('/article/{article}/edit' , 'ArticleController@edit')->name('article.edit');
Route::patch('/article/{article}' ,'ArticleController@update')->name('article.update');
Route::get('/article/category/{category}' , 'CategoryController@index1')->name('categories');

Route::get('/comments/{article}', 'CommentController@index');
Route::post('/comments', 'CommentController@store');

Route::get('/categories/all' , 'CategoryController@all');
Route::get('/articles', 'ArticleController@articles');
Route::get('categories', 'CategoryController@index');

Route::get('/videos', 'VideoController@index')->name('videos');
Route::get('/video/create', 'VideoController@create')->middleware('auth');
Route::post('/video/store' , 'VideoController@store')->name('video.store');
Route::get('/video/{video}' , 'VideoController@show')->name('video.show');

Route::delete('/comments/{comment}', 'CommentController@destroy');
