<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use DB;
use DataTables;
use Illuminate\Support\Str;

class TagsController extends Controller
{
    //
    public function list_records(Request $request){
        if ($request->ajax()) {

            $data = Tag::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('name'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['name'], $request->get('name')) ? true : false;
                            });
                        }
                        if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))){
                                    return true;
                                }
   
                                return false;
                            });
                        }
                    })           

                ->addColumn('action', function($row){
                    $btn = '<a class="anchorLess">
                    <a title="Click to Edit" href="' . route("tag.edit", $row->id ) . '" class="anchorLess"><i class="fas fa-edit info" aria-hidden="true" ></i></a>
                    <a title="Click to Delete" href="javascript:void(0)" class="anchorLess" onclick="deletetag(this,'.$row->id.');"><i class="fas fa-trash danger" aria-hidden="true" ></i></a>';
                    return $btn;
                })

               ->editColumn('status', function ($data) {
               if($data->status == 0) {
                   $stats = '<a title="Click to Enable" href="' . route("tag.status", ["g" => $data->id, "s" => 1]) .
                '" class="tableLink"><img alt="Click to Enable" src="/assets/images/off.png" /></a> Disabled';
                }else{
                     $stats = '<a title="Click to Disable" href="' . route("tag.status", ["g" => $data->id, "s" => 0]) .
                '" class="tableLink"><img title="Click to Disable" src="/assets/images/on.png" /></a> Enabled';
                }
                return $stats;     
                })         

                ->rawColumns(['action','status'])
                ->make(true);

            }
        return view('admin.tags.list');
    }

    public function add_form(){
    	return view('admin.tags.add');
    }


    public function create_record(Request $request){
		$request->validate([
                'name' => 'required|unique:tags',
            ], [
                'name.required' => 'Name is required',
            ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
            //dd($postData); 
        	$data = array(
        			'name' => $postData['name'],
					'status' => 1,
        			'created_at' => date('Y-m-d H:i:s')

        	);
			$record = Tag::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/tags/list')->with('status', 'success')->with('message', 'Tag Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            //return ['status' => 400, 'message' => $e->getMessage()];
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
            ], [
                'name.required' => 'Name is required',
            ]);
    	DB::beginTransaction();
    	try {
            //dd($postData);
        	$data = array(
        			'name' => $postData['name'],
        			'updated_at' => date('Y-m-d H:i:s')

        	);
        	
			$record = Tag::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	
        	return redirect('admin/tags/list')->with('status', 'success')->with('message', 'Tag Updated Successfully');
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
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
