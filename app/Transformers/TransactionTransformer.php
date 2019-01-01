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
			'user_id'			=> $transaction->user_id,
			'type_id'			=> $transaction->type_id,
			'category'			=> $transaction->category,
			'amount'			=> $transaction->amount,
			'note'				=> $transaction->note,
			'date'				=> date('d-m-Y', strtotime($transaction->date)),
			'user'				=> $transaction->user,
			'created_at'		=> date('d-M-Y')
		];
	}
}
