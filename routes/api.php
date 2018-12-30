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
		Route::post('user/upload', 'UserController@upload');
		Route::put('user/update', 'UserController@update');
		Route::delete('user/delete/{id}', 'UserController@destroy');

		//transaction
		Route::post('transactions', 'TransactionController@store');
		Route::get('transactions', 'TransactionController@index');
		Route::get('transactions/{id}', 'TransactionController@show');
		Route::put('transaction/{transaction}', 'TransactionController@update');
		Route::delete('transaction/{transaction}', 'TransactionController@destroy');
		//category
		Route::apiResource('category', CategoryController::class);
		//type
		Route::apiResource('type', TypeController::class);

	});

Route::group([    
    'middleware' => 'cors',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});