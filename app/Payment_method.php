<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    public $timestamps = false;
    protected $fillable = [
       	'name',
       	'description',
		'status',
	    'created_at',
	    'updated_at',
    ];
}
