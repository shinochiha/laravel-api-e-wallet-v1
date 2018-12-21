<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Transformers\UserTransformer;
use App\Notifications\SignupActivate;
use App\Http\Requests;
use JWTAuthException;
use App\User;
use JWTAuth;
use Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, User $user)
    {
    	$user = $user->create([

    		'name'				=> ucwords($request->name), 
    		'email'				=> $request->email,
    		'password'			=> Hash::make($request->password),
    		'activation_token'	=> str_random(60)

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

			$user->notify(new SignupActivate($user));

			$response = fractal()
				->item($user)
				->transformWith(new UserTransformer)
				->toArray();

			$response['token'] = $token;


			return response()->json($response, 201);

		}

    }

    public function registerActivate($token)
	{

	    $user = User::where('activation_token', $token)->first();
	    if (!$user) {
	        return response()->json([
	            'message' => 'This activation token is invalid.'
	        ], 404);
	    }
	    $user->active = true;
	    $user->activation_token = '';
	    $user->save();
	    return $user;

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
	    		$credentials['active'] = 1;

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


		    $response = [

		    	'status'=> 'true',
		    	'token'	=> $token

		    ];

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

    public function changePassword(ChangePasswordRequest $request)
    {
    	$input = $request->all();

    	$user = JWTAuth::authenticate(JWTAuth::getToken());

    	if(!Hash::check($input['current_password'], $user->password)) {

    		return response()->json(['message' => 'current password is not match']);

    	} else {

    		$user->update([

    		'password' => Hash::make($request->password)

    	]);

		return response()->json(['message' => 'Password successfully updated']);

    	}
    }
}
