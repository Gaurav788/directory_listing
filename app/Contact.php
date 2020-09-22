<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       	'user_id',
       	'name',
       	'email',
       	'mobile',
       	'reason_to_contact',
       	'message',
		'status',
	    'created_at',
	    'updated_at',
    ];
}