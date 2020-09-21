<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership_plan extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       	'name',
       	'details',
       	'price',
       	'currency',
		'duration',
		'status',
	    'created_at',
	    'updated_at',
    ];
}
