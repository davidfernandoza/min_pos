<?php

use Illuminate\Http\Request;

Route::get('/categories/get', 'CategoryController@getAll');
Route::get('/comments/get/{product}', 'CommentController@getAllByProduct');
