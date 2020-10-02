<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function user_detail()
	{
		return $this->belongsTo(User_detail::class);
	}
}
