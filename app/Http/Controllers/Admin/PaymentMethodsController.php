<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment_method;
use DB;

class PaymentMethodsController extends Controller
{
    public function list_records(Request $request){
        $data = Payment_method::get();
        return view('admin.paymentmethods.list', compact('data'));
    }

    public function add_form(){
    	return view('admin.paymentmethods.add');
    }

    public function create_record(Request $request){
		$request->validate([
            'name' => 'required|unique:payment_methods',
            'description' => 'required|min:5',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'You can not left description empty. Please add someting to describe payment method'
        ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
        		'name' => $postData['name'],
        		'description' => $postData['description'],
				'status' => $postData['status'],
        		'created_at' => date('Y-m-d H:i:s')
        	);
			$record = Payment_method::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/paymentmethods/list')->with('status', 'success')->with('message', 'Payment method Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function edit_form($id){
    	$record = Payment_method::find($id);
    	return view('admin.paymentmethods.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
            'name' => 'required|unique:payment_methods,name,'.$id,
            'description' => 'required|min:5',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'You can not left description empty. Please add someting to describe payment method'
        ]);
    	DB::beginTransaction();
    	try {
        	$data = array(
        		'name' => $postData['name'],
        		'description' => $postData['description'],
				'status' => $postData['status'],
        		'updated_at' => date('Y-m-d H:i:s')
        	);
			$record = Payment_method::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	return redirect('admin/paymentmethods/list')->with('status', 'success')->with('message', 'Payment method Updated Successfully');
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Payment_method::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Payment method Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $paymentmethod = Payment_method::find($getData['g']);
        $paymentmethod->status = $getData['s'];
        $paymentmethod->save();
        return redirect()->back()->with('status', 'success')->with('message', 'Payment method Status Changed Successfully');
    }
}