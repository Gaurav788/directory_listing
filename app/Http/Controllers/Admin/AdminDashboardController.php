<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use DB;
use App\User;

class AdminDashboardController extends Controller
{
    //
	public function index(){
        return view('admin.home');
	}
	
    public function update_record(Request $request){
		$validator = Validator::make($request->all(),[
                'first_name' => 'required',
                'last_name' => 'required',
            ], [
                'first_name.required' => 'First Name cannot be empty',
                'last_name.required' => 'Last Name cannot be empty',
            ]);
			
        if($validator->fails()){
            if($request->ajax()){
                return response()->json(["success"=>false,"errors"=>$validator->getMessageBag()->toArray()],200);
            }
        }
    	DB::beginTransaction();
    	try {
			$postData = $request->all();
            //dd($postData);
        	$data = array(
        			'first_name' => $postData['first_name'],
        			'last_name' => $postData['last_name'],
        			'updated_at' => date('Y-m-d H:i:s')

        	);
        	
			$record = User::where('id', $postData['adminid'])->update($data);
			DB::commit();
        	
            if ($record > 0) {
                return response()->json(["success"=>true,"msg"=>"User details updated Successfully"],200);
            }else{
                return response()->json(["success"=>false,"msg"=>"something went wrong"],200);
            }
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            throw $e;
            return response()->json(["success"=>false,"msg"=>$e], 200);
        }
    }
	
    public function update_password(Request $request){
		$validator = Validator::make($request->all(),[
                'oldpassword' => 'required',
                'newpassword' => 'required',
            ], [
                'oldpassword.required' => 'Old Password cannot be empty',
                'newpassword.required' => 'New Password cannot be empty',
            ]);
			
        if($validator->fails()){
            if($request->ajax()){
                return response()->json(["success"=>false,"errors"=>$validator->getMessageBag()->toArray()],200);
            }
        }
		
		$hashedPassword = Auth::user()->password;
 
		if (\Hash::check($request->oldpassword , $hashedPassword )) {
			if (!\Hash::check($request->newpassword , $hashedPassword)) {				
				$users = User::find(Auth::user()->id);
				$users->password = bcrypt($request->newpassword);
				User::where( 'id' , Auth::user()->id)->update( array( 'password' =>  $users->password));
				return response()->json(["success"=>true,"msg"=>"User password updated Successfully"],200);
            }
            else{                  
                return response()->json(["success"=>false,"msg"=>"new password can not be the old password!"],200);
            }
        }
        else{
			return response()->json(["success"=>false,"msg"=>'old password doesnt matched'], 200);
        }
 
    }
}
