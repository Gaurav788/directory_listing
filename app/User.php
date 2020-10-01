<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
            'first_name', 
            'last_name',
			'email',
			'password',
			'role_id',
			'social_type',
			'social_id',
			'created_at',
			'updated_at',
			'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
    public $timestamps = false;
	
	public function role()
	{
	   return $this->belongsTo(Role::class);
	}
	public function user_detail()
	{
	   return $this->hasOne(User_detail::class);
	}
	
}
