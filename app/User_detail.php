<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_detail extends Model
{
    public $timestamps = false;
    protected $fillable = [
       	'user_id',
	    'address',
       	'mobile',
	    'city',
		'state_id ',
       	'country_id ',
	    'zipcode',
		'profile_picture',
		'imagetype',
		'status',
	    'created_at',
	    'updated_at',
    ];
    public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function country()
	{
	   return $this->hasOne(Country::class);
	}
	public function state()
	{
	   return $this->hasOne(State::class);
	}
}
