<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment_gateway;
use DB;

class PaymentGatewaysController extends Controller
{
    public function list_records(Request $request){
        $data = Payment_gateway::get();
        return view('admin.paymentgateways.list', compact('data'));
    }

    public function add_form(){
    	return view('admin.paymentgateways.add');
    }

    public function create_record(Request $request){
		$request->validate([
            'name' => 'required|unique:payment_gateways',
            'description' => 'required|min:5',
            'payment_mode' => 'required',
            'api_key' => 'required',
            'secret_key' => 'required',
            'sandbox_url' => 'required',
            'live_url' => 'required',
            'email' => 'required',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'You can not left description empty. Please add someting to describe payment gateway',
            'payment_mode.required' => 'Please select one mode from this',
            'secret_key.required' => 'Please provide Secret key for this payment gateway',
            'api_key.required' => 'Please provide API Key for this payment gateway',
            'sandbox_url.required' => 'Please provide sandbox url for this payment gateway',
            'live_url.required' => 'Please provide live url for this payment gateway',
            'email.required' => 'You can not left email field empty',
        ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
        		'name' => $postData['name'],
        		'description' => $postData['description'],
        		'payment_mode' => $postData['payment_mode'],
        		'api_key' => $postData['api_key'],
        		'secret_key' => $postData['secret_key'],
        		'sandbox_url' => $postData['sandbox_url'],
        		'live_url' => $postData['live_url'],
        		'email' => $postData['email'],
				'status' => $postData['status'],
        		'created_at' => date('Y-m-d H:i:s')
        	);
			$record = Payment_gateway::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/paymentgateways/list')->with('status', 'success')->with('message', 'Payment gateway Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }

    public function edit_form($id){
    	$record = Payment_gateway::find($id);
    	return view('admin.paymentgateways.edit', compact('record'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
            'name' => 'required|unique:payment_gateways,name,'.$id,
            'description' => 'required|min:5',
            'payment_mode' => 'required',
            'api_key' => 'required',
            'secret_key' => 'required',
            'sandbox_url' => 'required',
            'live_url' => 'required',
            'email' => 'required',
            'status' => 'required'
        ], [
            'name.required' => 'Name is required',
            'description.required' => 'You can not left description empty. Please add someting to describe payment gateway',
            'payment_mode.required' => 'Please select one mode from this',
            'secret_key.required' => 'Please provide Secret key for this payment gateway',
            'api_key.required' => 'Please provide API Key for this payment gateway',
            'sandbox_url.required' => 'Please provide sandbox url for this payment gateway',
            'live_url.required' => 'Please provide live url for this payment gateway',
            'email.required' => 'You can not left email field empty',
        ]);
    	DB::beginTransaction();
    	try {
        	$data = array(
        		'name' => $postData['name'],
        		'description' => $postData['description'],
        		'payment_mode' => $postData['payment_mode'],
        		'api_key' => $postData['api_key'],
        		'secret_key' => $postData['secret_key'],
        		'sandbox_url' => $postData['sandbox_url'],
        		'live_url' => $postData['live_url'],
        		'email' => $postData['email'],
				'status' => $postData['status'],
        		'updated_at' => date('Y-m-d H:i:s')
        	);
			$record = Payment_gateway::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	return redirect('admin/paymentgateways/list')->with('status', 'success')->with('message', 'Payment method Updated Successfully');
        } catch ( \Exception $e ) {
            DB::rollback();
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Payment_gateway::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Payment gateway Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();
        $paymentgateway = Payment_gateway::find($getData['g']);
        $paymentgateway->status = $getData['s'];
        $paymentgateway->save();
        return redirect()->back()->with('status', 'success')->with('message', 'Payment gateway Status Changed Successfully');
    }
}