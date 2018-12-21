<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // protected $table = 'transactions'
    public $timestamps = false;
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
    	'type',
    	'category',
    	'amount',
    	'note',
    	'date',
    	'user',
        'account_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id');
    }
}
