<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use DB;

class TagsController extends Controller
{
    public function list_records(Request $request){
            $data = Tag::get();
        return view('admin.tags.list', compact('data'));
    }

    public function add_form(){
    	return view('admin.tags.add');
    }

    public function create_record(Request $request){
		$request->validate([
            'name' => 'required|unique:tags',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
        ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
        		'name' => $postData['name'],
				'status' => $postData['status'],
        		'created_at' => date('Y-m-d H:i:s')
        	);
			$record = Tag::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/tags/list')->with('status', 'success')->with('message', 'Tag Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function edit_form($id){
    	$record = Tag::find($id);
    	return view('admin.tags.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
            'name' => 'required|unique:tags,name,'.$id,
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
			$record = Tag::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	return redirect('admin/tags/list')->with('status', 'success')->with('message', 'Tag Updated Successfully');
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Tag::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Tag Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $tag = Tag::find($getData['g']);
        $tag->status = $getData['s'];
        $tag->save();
        return redirect()->back()->with('status', 'success')->with('message', 'Tag Status Changed Successfully');
    }
}