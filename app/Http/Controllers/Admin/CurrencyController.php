<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Currency;
use DB;

class CurrencyController extends Controller
{
    //
    public function list_records(Request $request){
            $data = Currency::get();
        return view('admin.currencies.list', compact('data'));
    }

    public function add_form(){
		
    	return view('admin.currencies.add');
    }


    public function create_record(Request $request){
		$request->validate([
                'name' => 'required|unique:currencies',
            ], [
                'name.required' => 'Name is required'
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
			$record = Currency::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/currencies/list')->with('status', 'success')->with('message', 'Currency Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            //return ['status' => 400, 'message' => $e->getMessage()];
        }
    }

    public function edit_form($id){
    	$record = Currency::find($id);
    	return view('admin.currencies.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
                'name' => 'required|unique:currencies,name,'.$id
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
        	
			$record = Currency::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	
        	return redirect('admin/currencies/list')->with('status', 'success')->with('message', 'Currency Updated Successfully');
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Currency::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Currency Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();

        $currencies = Currency::find($getData['g']);
        $currencies->status = $getData['s'];
        $currencies->save();

        return redirect()->back()->with('status', 'success')->with('message', 'Currency Status Changed Successfully');

    }
}
