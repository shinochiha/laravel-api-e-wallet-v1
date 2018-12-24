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
    	'category_id',
    	'amount',
    	'note',
    	'date',
    	'user'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
