<?php

Route::view('/', 'home')->name('home');
Route::get('/comments/product/{idProduct}', 'CommentController@getAllByProduct');

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

Route::group(['prefix' => 'categories'], function () {
	Route::get('/', 'CategoryController@getAll');
	Route::get('/{category}', 'CategoryController@get');
});


// Auth
Route::group(['middleware'=>'auth.basic'], function(){
	Route::post('/auth/logout', 'AuthController@logout')->name('logout');
	Route::post('/comments/store/{user}', 'CommentController@store');

	// Admin
	Route::group(['prefix' => 'admin', 'middleware'=>'role:ADMIN|SELLER'], function(){
		Route::get('/roles/', 'RoleController@getAll');
		Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
		Route::get('/categories', 'CategoryController@getAll')->name('categories');

		// Product
		Route::group(['prefix' => 'products'], function(){
			Route::get('/', 'ProductController@getAll')->name('products');
			Route::post('/store/{product?}', 'ProductController@store');
			Route::post('/delete/{product}', 'ProductController@delete');
		});

		// Category
		Route::group(['prefix' => 'categories'], function(){
			Route::get('/', 'CategoryController@getAll')->name('categories');
			Route::post('/store/{category?}', 'CategoryController@store');
			Route::post('/delete/{category}', 'CategoryController@delete');
		});

		// User
		Route::group(['prefix' => 'users', 'middleware'=>'role:ADMIN'], function(){
			Route::get('/', 'UserController@getAll')->name('users');
			Route::post('/store/{user?}', 'UserController@store');
			Route::post('/delete/{user}', 'UserController@delete');
		});
	});
});

