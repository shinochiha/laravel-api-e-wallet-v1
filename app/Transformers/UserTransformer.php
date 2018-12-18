<?php 

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

/**
 * 
 */
class UserTransformer extends TransformerAbstract
{
	
	public function transform(User $user)
	{
		return [
			'name'	 	 	=> $user->name,
			'email'		 	=> $user->email,
			'avatar'	 	=> $user->avatar,
			'phone_number'	=> $user->phone_number,
			'registered' 	=> date('Y-m-d')
		];
	}

}