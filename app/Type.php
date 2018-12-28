<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
    	'type'
    ];

    public $timestamps = false;

    protected $primaryKey = 'type_id';


}
