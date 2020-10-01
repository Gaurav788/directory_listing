<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;

class UserManageController extends Controller
{
    public function list_records(Request $request){
        $data = User::with('role', 'user_detail')->whereIn('role_id', [2,3])->get();
        return view('admin.users.list', compact('data'));
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $genre = User::find($getData['g']);
        $genre->status = $getData['s'];
        $genre->save();
        return redirect()->back()->with('status', 'success')->with('message', 'Status Updated Successfully');
    }
	
    public function del_record(Request $request){
        try {
            User::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"User Deleted Successfully"],200);
        }catch(Exception $ex){
			return response(['status' => 'errors', 'errors'=>$ex->getMessage()], 422);
        }
    }

    public function edit_form($id){
    	$record = User::with('user_detail')->find($id);
    	return view('admin.users.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
			'first_name' => 'required|string',  
			'last_name' => 'required|string', 
			'email' => 'required|email|unique:users,email,'.$id,
			'mobile' => 'required|digits:10',
                'status' => 'required'
        ], [
                'name.required' => 'Name is required',
                'description.required' => 'You can not left description empty. Please add someting to describe category'
            ]);
    	DB::beginTransaction();
    	try {
        	$users = User::findOrFail($id);
			$users->first_name = $postData['first_name'];
			$users->last_name = $postData['last_name'];
			$users->email = $postData['email'];
        	$users->status = $postData['status'];
			$users->user_detail->mobile = $postData['mobile'];
			$users->user_detail->updated_at = date('Y-m-d H:i:s');
			$users->updated_at = date('Y-m-d H:i:s');
			$users->push();
			DB::commit();        	
        	return redirect('admin/users/list')->with('status', 'success')->with('message', 'User Updated Successfully');        	
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function change_password($id){
    	return view('admin.users.password', compact('id'));
    }

    public function update_password(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
			'password' => 'nullable|required_with:password_confirmation|string|confirmed', 
        ], [
                'password.required' => 'Password is required',
                'password.confirmed' => 'Confirmed Password not matched with password'
            ]);
    	DB::beginTransaction();
    	try {
        	$data = array(
        		'password' => bcrypt($postData['password']),
        		'updated_at' => date('Y-m-d H:i:s')
        	);        	
			$record = User::where('id', $id)->update($data);
			DB::commit();        	
        	return redirect('admin/users/list')->with('status', 'success')->with('message', 'User Updated Successfully');
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
}