<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service;
use DB;

class ServicesController extends Controller
{
    public function list_records(Request $request){
        $data = Service::get();
        return view('admin.service.list', compact('data'));
    }

    public function add_form(){
    	return view('admin.service.add');
    }

    public function create_record(Request $request){
		$request->validate([
            'name' => 'required|unique:services',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required'
        ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
        		'name' => $postData['name'],
				'status' => $postData['status'],
        		'created_at' => date('Y-m-d H:i:s')
        	);
			$record = Service::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/services/list')->with('status', 'success')->with('message', 'Service Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function edit_form($id){
    	$record = Service::find($id);
    	return view('admin.service.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
            'name' => 'required|unique:services,name,'.$id,
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
    	DB::beginTransaction();
    	try {
        	$data = array(
        		'name' => $postData['name'],
				'status' => $postData['status'],
        		'updated_at' => date('Y-m-d H:i:s')
        	);  	
			$record = Service::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();        	
        	return redirect('admin/services/list')->with('status', 'success')->with('message', 'Service Updated Successfully');        	
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Service::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Service Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $service = Service::find($getData['g']);
        $service->status = $getData['s'];
        $service->save();
        return redirect()->back()->with('status', 'success')->with('message', 'Service Status Changed Successfully');
    }
}