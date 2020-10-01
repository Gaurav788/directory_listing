<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cms_page;
use DB;

class CmsPagesController extends Controller
{
    public function list_records(Request $request){
        $cmspages = Cms_page::get();
        return view('admin.cmspages.list', compact('cmspages'));
    }

    public function add_form(){
    	return view('admin.cmspages.add');
    }

    public function create_record(Request $request){
		$request->validate([
            'title' => 'required|unique:cms_pages',
            'slug' => 'required|min:5',
            'short_description' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_content' => 'required',
            'status' => 'required'
        ], [
            'title.required' => 'Title is required',
            'slug.required' => 'Slug is required',
            'short_description.required' => 'Short description is required',
            'description.required' => 'You can not left description empty. Please add someting to describe page',
            'meta_title.required' => 'You can not left meta title empty.',
            'meta_keyword.required' => 'You can not left meta keyword empty.',
            'meta_content.required' => 'You can not left meta content empty.'
        ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
        		'title' => $postData['title'],
        		'slug' => $postData['slug'],
        		'short_description' => $postData['short_description'],
        		'description' => $postData['description'],
        		'meta_title' => $postData['meta_title'],
        		'meta_keyword' => $postData['meta_keyword'],
        		'meta_content' => $postData['meta_content'],
				'status' => $postData['status'],
        		'created_at' => date('Y-m-d H:i:s')
        	);
			$record = Cms_page::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/cmspages/list')->with('status', 'success')->with('message', 'CMS Page Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();            
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function edit_form($id){
    	$record = Cms_page::find($id);
    	return view('admin.cmspages.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
			'title' => 'required|unique:cms_pages,title,'.$id,
            'slug' => 'required|min:5',
            'short_description' => 'required',
            'description' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_content' => 'required',
            'status' => 'required'
        ], [
            'title.required' => 'Title is required',
            'slug.required' => 'Slug is required',
            'short_description.required' => 'Short description is required',
            'description.required' => 'You can not left description empty. Please add someting to describe page',
            'meta_title.required' => 'You can not left meta title empty.',
            'meta_keyword.required' => 'You can not left meta keyword empty.',
            'meta_content.required' => 'You can not left meta content empty.'
        ]);
    	DB::beginTransaction();
    	try {
        	$data = array(
        		'title' => $postData['title'],
        		'slug' => $postData['slug'],
        		'short_description' => $postData['short_description'],
        		'description' => $postData['description'],
        		'meta_title' => $postData['meta_title'],
        		'meta_keyword' => $postData['meta_keyword'],
        		'meta_content' => $postData['meta_content'],
				'status' => $postData['status'],
        		'updated_at' => date('Y-m-d H:i:s')

        	);        	
			$record = Cms_page::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();        	
        	return redirect('admin/cmspages/list')->with('status', 'success')->with('message', 'CMS Page Updated Successfully');        	
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Cms_page::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"CMS Page Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $cmspage = Cms_page::find($getData['g']);
        $cmspage->status = $getData['s'];
        $cmspage->save();
        return redirect()->back()->with('status', 'success')->with('message', 'CMS Page Status Changed Successfully');
    }
}