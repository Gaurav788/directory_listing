<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_gateway extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       	'name',
       	'description',
       	'api_key',
       	'secret_key',
       	'sandbox_url',
       	'live_url',
       	'email',
       	'payment_mode',
		'status',
	    'created_at',
	    'updated_at',
    ];
}
