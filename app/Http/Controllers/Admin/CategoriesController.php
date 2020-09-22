<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoriesController extends Controller
{
    //
    public function list_records(Request $request){
            $category = Category::get();
        return view('admin.category.list', compact('category'));
    }

    public function add_form(){
    	return view('admin.category.add');
    }


    public function create_record(Request $request){
		$request->validate([
                'name' => 'required|unique:categories',
                'description' => 'required|min:5'
            ], [
                'name.required' => 'Name is required',
                'description.required' => 'You can not left description empty. Please add someting to describe category'
            ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
            //dd($postData); 
        	$data = array(
        			'name' => $postData['name'],
        			'description' => $postData['description'],
					'status' => 1,
        			'created_at' => date('Y-m-d H:i:s')

        	);
			$record = Category::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/categories/list')->with('status', 'success')->with('message', 'Category Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            //return ['status' => 400, 'message' => $e->getMessage()];
        }
    }

    public function edit_form($id){
    	$record = Category::find($id);
    	return view('admin.category.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
                'name' => 'required|unique:categories,name,'.$id,
                'description' => 'required|min:5'
            ], [
                'name.required' => 'Name is required',
                'description.required' => 'You can not left description empty. Please add someting to describe category'
            ]);
    	DB::beginTransaction();
    	try {
            //dd($postData);
        	$data = array(
        		'name' => $postData['name'],
        		'description' => $postData['description'],
        		'updated_at' => date('Y-m-d H:i:s')
        	);
        	
			$record = Category::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	
        	return redirect('admin/categories/list')->with('status', 'success')->with('message', 'Category Updated Successfully');
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Category::where('id',$request->input('id'))->delete();
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
