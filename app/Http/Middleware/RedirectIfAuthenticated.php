<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
						 
			switch(Auth::user()->role_id){
				case 2:
				$this->redirectTo = '/user/dashboard';
				return $this->redirectTo;
					break;
				case 1:
					$this->redirectTo = '/admin/dashboard';
					return $this->redirectTo;
					break;
				default:
					$this->redirectTo = '/home';
					return $this->redirectTo;
			}
        } else {
			
            return $next($request);
        }
    }
}
