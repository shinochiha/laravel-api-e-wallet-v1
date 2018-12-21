<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\PasswordReset;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\ResetRequest;


class PasswordResetController extends Controller
{
    public function create (CreateRequest $request)
    {

    	$user = User::where('email', $request->email)->first();

    	if (!$user)
    		return response()->json([
    			'message' => "We can't find a user with that e-mail address."
    		], 404);

    	$passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
             'email' => $user->email,
             'token' => str_random(60)
            ]
        );

        if ($user && $passwordReset)
        	$user->notify(
        		new PasswordResetRequest($passwordReset->token, $user->email)
        	);

        return response()->json([
        	'message' => "we have e-mailed your pass password reset link!"
        ],200);
    }

    public function find($token)
    {
    	$passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset)
            return response()->json([

                'message' => 'This password reset token is invalid.'
            ], 404);

        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {

            $passwordReset->delete();
            return response()->json([

                'message' => 'This password reset token is invalid.'
            ], 404);
            
        }
        return response()->json($passwordReset);
    }

    public function reset(ResetRequest $request)
    {
        $passwordReset = PasswordReset::where([

            ['token', $request->token],
            ['email', $request->email]

        ])->first();

        if (!$passwordReset)
            return response()->json([

                'message' => 'This password reset token is invalid.'
            ], 404);

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user)

            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);

        $user->password = Hash::make($request->password);

        $user->save();

        $passwordReset->delete();

        $user->notify(new PasswordResetSuccess($passwordReset));

        $response = [

            'message' => 'Reset Password Success',
            'data'    => $user

        ];

        return response()->json($response, 201);
    }

}
