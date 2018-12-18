<?php

use Illuminate\Http\Request;

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');
Route::get('auth/logout', 'AuthController@logout');
Route::get('user', 'UserController@getAuthUser');
Route::get('users', 'UserController@users');
Route::post('user/upload', 'UserController@upload');
Route::put('user/update', 'UserController@update');
