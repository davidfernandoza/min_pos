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

Route::view('/', 'home')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('/user/login', 'AuthController@login')->name('user.login');
Route::post('/user/register', 'UserController@store')->name('user.register');

Route::group(['middleware'=>'auth'], function(){
	Route::post('/logout', 'AuthController@logout')->name('logout');

	Route::group(['middleware'=>'admin'], function(){
		Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

	});
});
