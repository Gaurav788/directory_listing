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
       	'currency_id',
		'duration',
		'status',
	    'created_at',
	    'updated_at',
    ];
    public function currency()
	{
		return $this->belongsTo(Currency::class);
	}
}
