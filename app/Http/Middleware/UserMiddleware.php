<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		if(auth::check() && Auth::user()->role_id == 2 && Auth::user()->status == 1){
			return $next($request);
		}
		else {
			Auth::logout();
			return redirect()->route('login')->with('status', 'error')->with('message', 'Your account has been blocked or disabled by administrator!');
		}
    }
}
