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
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use JWTAuth;
use Auth;


class AuthController extends Controller
{
	/*
	*Method register user,in filed ,name,email,password
	*/
    public function register(RegisterRequest $request, User $user)
    {
    	$user = $user->create([

    		'name'				=> ucwords($request->name), 
    		'email'				=> $request->email,
    		'password'			=> Hash::make($request->password),
    		'activation_token'	=> str_random(60)

    	]);

			$credentials = $request->only('email', 'password');

			try {
            // attempt to verify the credentials and create a token for the user
	            if (! $token = JWTAuth::attempt($credentials)) {
	                return response()->json(['error' => 'invalid_credentials'], 401);
	            }
	        } catch (JWTException $e) {
	            // something went wrong whilst attempting to encode the token
	            return response()->json(['error' => 'could_not_create_token'], 500);
	        }

	        // to send verify at gmail
	        $user->notify(new SignupActivate($user));

	        // response with fractal
			$response = fractal()
				->item($user)
				->transformWith(new UserTransformer)
				->toArray();

			$response['access_token'] = compact('token');

	        // all good so return the token
	        return response()->json($response, 201);
    }

    /*
    * Method activation acount send in gmail
    */
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

	    return redirect('https://superwallet.herokuapp.com/verification');

	}
	/*
	* Method Login for user in field email and password
	*/
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
		    	'access_token' 	=> $token,
				'token_type' 	=> 'bearer'


		    ];

	    	return response()->json($response, 200);

	    }	

	    	return response()->json(['msg' => 'Email or Password are incorrect'], 404);
    }

    /*
    * Method Logout for user / delete token user
    */
    public function logout()
    {

        try {

            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['success' => true, 'message' => 'User logged Out successfully'], 200);

        } catch (JWTException $e) {

            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
            
        }
    }

    /*
    * Method Change password user,in field,current_password,newpassword,confirmnewpassword
    */
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
