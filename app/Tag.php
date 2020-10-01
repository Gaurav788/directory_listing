<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'name',
		'status',
		'created_at',
		'updated_at',
    ];
}
