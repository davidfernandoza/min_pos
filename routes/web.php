<?php

Route::view('/', 'home')->name('home');

Route::group(['prefix' => 'auth'], function () {
	Route::view('/login', 'auth.login')->name('login');
	Route::view('/register', 'auth.register')->name('register');
	Route::post('/login', 'AuthController@login')->name('auth.login');
	Route::post('/register', 'UserController@store')->name('auth.register');
});

Route::group(['prefix' => 'products'], function () {
	Route::get('/search/', 'ProductController@search')->name('search');
	Route::get('/{product?}', 'ProductController@get');
});

Route::group(['prefix' => 'category'], function () {
	Route::get('/{category}', 'CategoryController@get');
});


Route::group(['middleware'=>'auth'], function(){
	Route::post('/auth/logout', 'AuthController@logout')->name('logout');
	Route::post('/comments/store/{user}', 'CommentController@store');

	Route::group(['prefix' => 'admin'], function(){
		Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
		Route::get('/categories', 'CategoryController@getAll')->name('categories');
		Route::get('/products', 'ProductController@getAll')->name('products');
		Route::get('/users', 'UserController@getAll')->name('users');
	});
});
