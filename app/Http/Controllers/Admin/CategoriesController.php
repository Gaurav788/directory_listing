<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoriesController extends Controller
{
    public function list_records(Request $request){
        $category = Category::with('parent')->get();
        return view('admin.category.list', compact('category'));
    }

    public function add_form(){
        $categorylist = Category::where('status', 1)->get();
    	return view('admin.category.add', compact('categorylist'));
    }

    public function create_record(Request $request){
		$request->validate([
            'parent_id' => 'required',
            'name' => 'required|unique:categories',
            'sort_order' => 'required|unique:categories',
            'description' => 'required|min:5',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'You can not left description empty. Please add someting to describe category'
        ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
				'parent_id' => $postData['parent_id'],
        		'name' => $postData['name'],
        		'sort_order' => $postData['sort_order'],
        		'description' => $postData['description'],
				'status' => $postData['status'],
        		'created_at' => date('Y-m-d H:i:s')
        	);
			$record = Category::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/categories/list')->with('status', 'success')->with('message', 'Category Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function edit_form($id){
    	$record = Category::find($id);
        $categorylist = Category::where('status', 1)->get();
    	return view('admin.category.edit', compact('record', 'categorylist'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
            'parent_id' => 'required',
            'name' => 'required|unique:categories,name,'.$id,
            'sort_order' => 'required|unique:categories,sort_order,'.$id,
            'description' => 'required|min:5',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'You can not left description empty. Please add someting to describe category'
        ]);
    	DB::beginTransaction();
    	try {
        	$data = array(
        		'parent_id' => $postData['parent_id'],
        		'name' => $postData['name'],
        		'description' => $postData['description'],
        		'sort_order' => $postData['sort_order'],
        		'status' => $postData['status'],
        		'updated_at' => date('Y-m-d H:i:s')
        	);        	
			$record = Category::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();        	
        	return redirect('admin/categories/list')->with('status', 'success')->with('message', 'Category Updated Successfully');        	
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Category::where('id',$request->input('id'))->orWhere('parent_id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Category Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $category = Category::find($getData['g']);
        $category->status = $getData['s'];
        $category->save();
        return redirect()->back()->with('status', 'success')->with('message', 'Category Status Changed Successfully');
    }
}