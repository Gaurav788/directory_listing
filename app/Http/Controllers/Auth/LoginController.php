<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */	 
    protected $maxAttempts = 3; // default is 5
    protected $decayMinutes = 2; // default is 1
    protected $redirectTo;
    public function redirectTo()
    {
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
         
        // return $next($request);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        $this->middleware('guest')->except('logout');
    }
	
	
    /*public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        {
			switch(Auth::user()->role_id){
				case 2:
					return redirect()->route('user.dashboard');
					break;
				case 1:
					return redirect()->route('admin.dashboard');
					break;
				default:
					return redirect()->route('/home');
			}
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
          
    }*/
}
