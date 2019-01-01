<?php 

namespace App\Transformers;

use App\User;
use App\Transformers\TransactionTransformer;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

/**
 * 
 */
class UserTransformer extends TransformerAbstract
{
	protected $defaultIncludes = [
		'transactions'
	];

	public function transform(User $user)
	{
		return [
			'id'			=> 	$user->id,
			'name'	 	 	=> 	$user->name,
			'email'		 	=> 	$user->email,
			'avatar'	 	=> 	$user->avatar,
			'phone_number'	=> 	$user->phone_number,
			'status'		=> 	$user->active,
			'balance'		=> 	$user->transactions->sum('amount'),
			'created_at'	=> 	Carbon::parse($user->created_at)->diffForHumans(),
		];
	}

	public function includeTransactions(User $user)
	{
		$transactions = $user->transactions;

		return $this->collection($transactions, new TransactionTransformer);
	}
}
