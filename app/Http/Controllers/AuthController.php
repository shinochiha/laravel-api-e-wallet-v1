<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;


use App\Http\Requests;
use App\User;
use App\Transformers\UserTransformer;
use JWTAuth;
use JWTAuthException;
use Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, User $user)
    {
    	$user = $user->create([
    		'name'		=> htmlspecialchars(ucwords($request->name)), 
    		'email'		=> htmlspecialchars($request->email),
    		'password'	=> htmlspecialchars(Hash::make($request->password))
    	]);

			$credentials = [
				'email' => $request->email,
				'password' => $request->password
			];

			if($user->save()) {
				$token = null;
				try {
					if(!$token = JWTAuth::attempt($credentials)) {
						return response()->json([
							'msg' => 'Email or Password are incorrect' 
						], 404);
					}
				} catch (JWTException $e) {
					return response()->json([
						'msg' => 'Failed to create token'
					], 404);
				}

			$response = fractal()
				->item($user)
				->transformWith(new UserTransformer)
				->toArray();

			$response['token'] = $token;


			return response()->json($response, 201);
		}
    }

    public function login(Request $request, User $user)
    {
    	$email 		= $request->input('email');
    	$password 	= $request->input('password');

    	if($user = User::where('email', $email)->first()) {
	    		$credentials = [
	    			'email' => $email,
	    			'password' => $password
	    		];

	    		$token = null;
	    		try {
	    			if(!$token = JWTAuth::attempt($credentials)) {
	    				return response()->json([
	    					'msg' => 'Email or Password are incorrect' 
	    				], 404);
	    			}
	    		} catch (JWTException $e) {
	    			return response()->json([
	    				'msg' => 'Failed to create token'
	    			], 404);
	    		}

	    	$response = fractal()
		    	->item($user)
		    	->transformWith(new UserTransformer)
		    	->toArray();

		    $response['token'] = $token;

	    	return response()->json($response, 200);
	    }	
	    	return response()->json(['msg' => 'Email or Password are incorrect'], 404);
    }

    public function logout()
    {

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['success' => true, 'message' => 'User logged Out successfully'], 200);
        } catch (JWTException $e) {
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }
}
