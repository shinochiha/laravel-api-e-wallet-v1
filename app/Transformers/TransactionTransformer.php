<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

/**
*
*/
class TransactionTransformer extends TransformerAbstract
{
	public function transform(Transaction $transaction)
	{
		return [
			'transaction_id'	=> $transaction->transaction_id,
			'type'				=> $transaction->type,
			'category'			=> $transaction->category,
			'amount'			=> $transaction->amount,
			'note'				=> $transaction->note,
			'date'				=> $transaction->date,
			'user'				=> $transaction->user
		];
	}
}
