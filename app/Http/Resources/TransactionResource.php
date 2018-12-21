<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'account_id'       => $this->account_id,
            'transaction_id'=> $this->transaction_id,
            'type'          => $this->type, 
            'category'      => $this->category,
            'amount'        => $this->amount,
            'note'          => $this->note,
            'date'          => $this->date,
            'user'          => $this->user,
        ];
    }
}
