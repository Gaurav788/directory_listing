<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Validator;
use App\User; 
use Illuminate\Support\Str;
class ApiAuthController extends Controller 
{
	/** 
	* Register API 
	* 
	* @return \Illuminate\Http\Response 
	*/ 
	public function register(Request $request) 
	{ 
		
		$validator = Validator::make($request->all(), [ 
		  'first_name' => 'required|string',  
		  'last_name' => 'required|string', 
		  'email' => 'required|email|unique:users', 
		  'password' => 'required|string|min:6', 
		  
		]);
		if ($validator->fails()) { 
			return response(['status' => 'errors', 'errors'=>$validator->errors()->all()], 422);
		}
		$postArray = $request->all(); 
	   
		$postArray['password'] = bcrypt($postArray['password']); 
		$postArray['status'] = 0; 
		$postArray['role_id'] = 2; 
		$postArray['social_type'] = 'website'; 
		$postArray['social_id'] = 0; 
		$postArray['created_at'] = date('Y-m-d H:i:s'); 
		$user = User::create($postArray); 
		
        $accessToken = $user->createToken('authToken')->accessToken;

        return response(['status' => 'success',  'user' => $user, 'access_token' => $accessToken]);
		/*$success['token'] = $user->createToken('Laravel Password Grant Client')->accessToken;	
		$success['first_name'] =  $user->first_name;
		return response()->json([
		  'status' => 'success',
		  'data' => $success,
		]); */
	}
	public function login (Request $request) {
		$loginData = $request->validate([
			'email' => 'required|string|email|max:255',
			'password' => 'required|string|min:6',
        ]);
		
        if (!auth()->attempt($loginData)) {
            return response(['status' => 'errors', 'message' => 'Invalid Credentials']);
        }
		

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['status' => 'success', 'user' => auth()->user(), 'access_token' => $accessToken]);
	}
}