<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UploadRequest;
use App\User;
use App\Http\Requests;
use JWTAuth;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    /*
    * mehod user for see all users
    */
    public function users(User $user)
    {
    	$users = $user->all();

    	return fractal()
    		->collection($users)
    		->transformWith(new UserTransformer)
    		->toArray();
    }

    /*
    *method see one user, for see data one user
    */
    public function getAuthUser(Request $request)
    {

    	$user = JWTAuth::authenticate(JWTAuth::getToken());

        return fractal()
        	->item($user)
        	->transformWith(new UserTransformer)
        	->toArray();
            
    }

    /*
    *method upload for upload foto/avatar in profile user
    */
    public function upload(UploadRequest $request)
    {

    	$user = JWTAuth::authenticate(JWTAuth::getToken());
        $file = $request->file('avatar');
        $filename = date('Ymd') . str_random(6) . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images'),$filename);
        DB::table('users')
            ->where('id', $user->id)
            ->update(['avatar' => url('images/'.$filename)]);
            
        return response()->json(['message' => 'photo uploaded'],201);   

    }

    /*
    * Method Update for update name and phone_number user
    */
    public function update(UpdateRequest $request)
    {

        $user = JWTAuth::authenticate(JWTAuth::getToken());

        $name           = $request->input('name');
        $phone_number   = $request->input('phone_number');

        $user->update([

            'name'        => ucwords($name),
            'phone_number'=> $phone_number,

        ]);

        $response = [

            'msg' => 'Update data success',
            'data' => $user

        ];

        return fractal()
        	->item($user)
        	->transformWith(new UserTransformer)
        	->toArray();

    }

    public function destroy($id)
    {
        $user = User::where('id' , $id)->delete();

        if ($user) {

            return response()->json([

                'message' => 'User has been deleted'

            ],200);

        } else {

            return response()->json([

                'message' => 'User not found'
                
            ], 404);

        }
    }

}
