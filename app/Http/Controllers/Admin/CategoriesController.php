<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use DB;
use DataTables;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    //
    public function list_records(Request $request){
        if ($request->ajax()) {

            $data = Category::get();
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
                                }else if (Str::contains(Str::lower($row['description']), Str::lower($request->get('search')))) {
                                    return true;
                                }
   
                                return false;
                            });
                        }
                    })           

                ->addColumn('action', function($row){
                    $btn = '<a class="anchorLess">
                    <a title="Click to Edit" href="' . route("category.edit", $row->id ) . '" class="anchorLess"><i class="fas fa-edit info" aria-hidden="true" ></i></a>
                    <a title="Click to Delete" href="javascript:void(0)" class="anchorLess" onclick="deletecategory(this,'.$row->id.');"><i class="fas fa-trash danger" aria-hidden="true" ></i></a>';
                    return $btn;
                })

               ->editColumn('status', function ($data) {
               if($data->status == 0) {
                   $stats = '<a title="Click to Enable" href="' . route("category.status", ["g" => $data->id, "s" => 1]) .
                '" class="tableLink"><img alt="Click to Enable" src="/assets/images/off.png" /></a> Disabled';
                }else{
                     $stats = '<a title="Click to Disable" href="' . route("category.status", ["g" => $data->id, "s" => 0]) .
                '" class="tableLink"><img title="Click to Disable" src="/assets/images/on.png" /></a> Enabled';
                }
                return $stats;     
                })         

                ->rawColumns(['action','status'])
                ->make(true);

            }
        return view('admin.category.list');
    }

    public function add_form(){
    	return view('admin.category.add');
    }


    public function create_record(Request $request){
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
            //dd($postData); 
        	$data = array(
        			'name' => $postData['name'],
        			'description' => $postData['Description'],
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
            dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            //return ['status' => 400, 'message' => $e->getMessage()];
        }
    }

    public function edit_form($id){
    	$record = Category::find($id);
    	return view('admin.category.edit', compact('record'));
    }

    public function update_record(Request $request){
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
            //dd($postData);
        	$data = array(
        			'name' => $postData['name'],
        			'description' => $postData['Description'],
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
