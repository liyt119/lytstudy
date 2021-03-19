<?php

use Illuminate\Support\Facades\Route;

Route::get('/','PagesController@index')->name('index');

Route::get('/map','PagesController@map')->name('map');
Route::get('/upload','PagesController@upload')->name('upload');

//基站页面
//Route::get('registers/{search?}','RegistersController@index')->name('registers.index');
Route::post('/jizhan/search', 'RegistersController@index')->name('jizhan.search');

//用户页面
//Route::resource('users','UsersController');
Route::get('/usershow', 'UsersController@show')->name('usersshow');


//输入用户信息显示搜索结果
Route::get('/res', 'UsersController@root')->name('res.root');
Route::get('/res/search', 'UsersController@root');
Route::post('/res/search', 'UsersController@search')->name('res.search');
