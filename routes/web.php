<?php

Route::view('/', 'home')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::post('/user/login', 'AuthController@login')->name('user.login');
Route::post('/user/register', 'UserController@store')->name('user.register');
Route::get('/products/{product?}', 'ProductController@get');
Route::get('/products/category/{category}', 'ProductController@getAllByCategory');

Route::group(['middleware'=>'auth'], function(){
	Route::post('/logout', 'AuthController@logout')->name('logout');
	Route::post('/comments/store/{user}', 'CommentController@store');

	Route::group(['middleware'=>'admin'], function(){
		Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

	});
});
