<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Image;
use DB;
use Session;
use App\User;
use App\User_detail;

class AdminDashboardController extends Controller
{
	
    public function __construct()
    {
	}
	public function index(){		
		$users_details = User_detail::where('user_id' , Auth::user()->id)->first();
		if($users_details != null)//if exist
		{
			Session::put('userdetails', $users_details);
		}
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
        	$data = array(
        		'first_name' => $postData['first_name'],
        		'last_name' => $postData['last_name'],
        		'updated_at' => date('Y-m-d H:i:s')
        	);
        	//If User uploaded profile pictuce
            if($request->hasFile('profile_pic')) {
                $allowedfileExtension=['jpg','png'];
                $file = $request->file('profile_pic');
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if($check) {
					$image_resize = Image::make($file)->resize( null, 90, function ( $constraint ) {
						$constraint->aspectRatio();
					})->encode( $extension ); 
					$users_details = User_detail::where('user_id' , Auth::user()->id)->first();
					if($users_details == null) {
						$users_details = User_detail::create([
							'user_id' => Auth::user()->id,
							'profile_picture'=>$image_resize,
							'imagetype' => $extension,
							'status' => 1,
							'created_at' => date('Y-m-d H:i:s')
						]); 
					} else {
						$users_details->update(['profile_picture'=>$image_resize, 'imagetype' => $extension, 'updated_at' => date('Y-m-d H:i:s')]);
					}
                } else {
					return response()->json(["success" => false, "msg" => "Please select png or jpg images."],200);
                }
            }
			$record = User::where('id', $postData['adminid'])->update($data);
			DB::commit();        	
            if ($record > 0) {
				$users_details = User_detail::where('user_id' , Auth::user()->id)->first();
				if($users_details != null)
				{
					Session::put('userdetails', $users_details);
				}
                return response()->json(["success" => true, "msg" => "User details updated Successfully"],200);
            } else{
                return response()->json(["success" => false, "msg" => "something went wrong"],200);
            }        	
        } catch ( \Exception $e ) {
            DB::rollback();
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
				$users->save();
				return response()->json(["success"=>true,"msg"=>"User password updated Successfully"],200);
            } else{                  
                return response()->json(["success"=>false,"msg"=>"new password can not be the old password!"],200);
            }
        } else{
			return response()->json(["success"=>false,"msg"=>'old password doesnt matched'], 200);
        }
 
    }
}