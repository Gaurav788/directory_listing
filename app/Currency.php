<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
       			'name',
				'status',
	    		'created_at',
	    		'updated_at',
    ];
    public function membership_plan()
	{
		return $this->hasOne(Membership_plan::class);
	}
}
