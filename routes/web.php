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

//文件导入
//Route::get('/registers_import', 'RegistersController@import')->name('registers.import');

Route::get('excel/export','RegistersController@export')->name('registers.export');
Route::get('excel/import','RegistersController@import')->name('registers.import');
Route::get('import','RegistersController@handle')->name('handle');
//Route::post('excel/_import','RegistersController@import_handle')->name('registers_import_handle');
//Route::get('/registers_import_check', 'RegistersController@import_check')->name('registers.import_check');

//Auth::routes();
// 用户身份验证相关的路由
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// 用户注册相关路由
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// 密码重置相关路由
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email 认证相关路由
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');


//Route::get('/home', 'HomeController@index')->name('home');
