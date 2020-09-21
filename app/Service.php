<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       			'name',
				'status',
	    		'created_at',
	    		'updated_at',
    ];
}
