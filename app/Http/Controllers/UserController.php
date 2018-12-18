<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function users(User $user)
    {
    	$users = $user->all();

    	return fractal()
    		->collection($users)
    		->transformWith(new UserTransformer)
    		->toArray();
    }
}
