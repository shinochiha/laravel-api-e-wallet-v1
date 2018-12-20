<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

/**
*
*/
class TransactionTransformer extends TransformerAbstract
{
	public function transform(Transaction $transaction)
	{
		return [
			'id'		=> $transaction->transaction_id,
			'type'		=> $transaction->type,
			'category'	=> $transaction->category,
			'amount'	=> $transaction->note,
			'note'		=> $transaction->date,
			'user'		=> $transaction->user
		];
	}
}
