<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Socialite;
use Auth;
use Exception;

class SocialAuthLinkedinController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }


    public function callback()
    {
        try {
            $linkdinUser = Socialite::driver('linkedin')->user();
            $existUser = User::where('email',$linkdinUser->email)->first();
            if($existUser) {
                Auth::loginUsingId($existUser->id);
            }
            else {
                $user = new User;
                $user->role_id = 3;
                $user->first_name = $linkdinUser->name;
                $user->email = $linkdinUser->email;
                $user->social_type = 'Linkdin';
                $user->social_id = $linkdinUser->id;
                $user->password = bcrypt(rand(1,10000));
                $user->status = 1;
        		$user->created_at = date('Y-m-d H:i:s');
                $user->save();
                Auth::loginUsingId($user->id);
            }
            return redirect()->to('/Company/Dashboard');
        } 
        catch (Exception $e) {
            return 'error';
        }
    }
}