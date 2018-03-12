<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('/signup', 'UsersController@create')->name('signup');

Route::resource('users', 'UsersController');

/**
 * Route::resource('users', 'UsersController'); 
 * Laravel 遵循 RESTful 架构原则，资源路由相当于下面路由功能。
 * 
 * @link https://laravel-china.org/index.php/docs/laravel/5.6/controllers#restful-naming-resource-routes
 * 
 */
// Route::get('/users', 'UsersController@index')->name('users.index'); // 显示所有用户列表页面
// Route::get('/users/{user}', 'UsersController@show')->name('users.show'); // 显示用户个人信息页面
// Route::get('/users/create', 'UsersController@create')->name('users.create'); // 创建用户信息页面
// Route::post('/users', 'UsersController@store')->name('users.store'); // 创建用户
// Route::post('/users/{user}/edit', 'UsersController@edit')->name('users.edit'); // 编辑用户个人信息页面
// Route::patch('/users/{user}', 'UsersController@update')->name('users.update'); // 更新用户
// Route::delete('/users/{user}', 'UsersController@destory')->name('users.destory'); // 删除用户
