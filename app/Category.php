<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'category_id';

    protected $fillable = [
    	'name'
    ];

    public function transaction()
    {
    	$this->hasMany('App\Transaction', 'transaction_id');
    }
}
