<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       	'user_id',
       	'name',
       	'email',
       	'avtar',
       	'feedback',
       	'url',
		'status',
	    'created_at',
	    'updated_at',
    ];
}
