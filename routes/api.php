<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function() {
	
		// Authentication
		Route::post('auth/register', 'AuthController@register');
		Route::post('auth/login', 'AuthController@login');
		Route::get('auth/logout', 'AuthController@logout');
    	Route::post('changepassword', 'AuthController@changePassword');
    	Route::get('register/activate/{token}', 'AuthController@registerActivate');


		// user
		Route::get('user', 'UserController@getAuthUser');
		Route::get('users', 'UserController@users');
		Route::post('user/upload', 'UserController@upload');
		Route::put('user/update', 'UserController@update');
		Route::delete('user/delete/{id}', 'UserController@destroy');

		//transaction
		Route::apiResource('transactions', TransactionController::class);

	});

Route::group([    
    'middleware' => 'cors',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});