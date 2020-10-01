<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Membership_plan;
use App\Currency;
use DB;

class MembershipPlansController extends Controller
{
    //
    public function __construct()
    {
       
    }

    public function list_records(Request $request){
            $plans = Membership_plan::get();
        return view('admin.membershipplans.list', compact('plans'));
    }

    public function add_form(){
            $currency_data = Currency::where('status', 1)->get();
    	return view('admin.membershipplans.add', compact('currency_data'));
    }


    public function create_record(Request $request){
		$request->validate([
                'name' => 'required|unique:membership_plans',
                'details' => 'required|min:5',
                'price' => 'required|numeric|gte:0',
                'currency' => 'required',
                'duration' => 'required'
            ], [
                'name.required' => 'Name is required',
                'details.required' => 'You can not left details empty. Please add someting to describe plan',
                'price.required' => 'You can not left price empty.',
                'currency.required' => 'Please select any one currency.',
                'duration.required' => 'Please select one duration.'
            ]);
    	DB::beginTransaction();
    	try {
        	$postData = $request->all();
        	$data = array(
        			'name' => $postData['name'],
        			'details' => $postData['details'],
        			'currency_id' => $postData['currency'],
        			'price' => $postData['price'],
        			'duration' => $postData['duration'],
					'status' => 1,
        			'created_at' => date('Y-m-d H:i:s')

        	);
            //dd($data); 
			$record = Membership_plan::create($data);
			DB::commit();
        	if($record){
        		return redirect('admin/membershipplan/list')->with('status', 'success')->with('message', 'Membership plan Created Successfully');
        	}
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
            //return ['status' => 400, 'message' => $e->getMessage()];
        }
    }

    public function edit_form($id){
    	$record = Membership_plan::find($id);
            $currency_data = Currency::where('status', 1)->get();
    	return view('admin.membershipplans.edit', compact('record', 'currency_data'));
    }

    public function update_record(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
                'name' => 'required|unique:membership_plans,name,'.$id,
                'details' => 'required|min:5',
                'price' => 'required|numeric|gte:0',
                'currency' => 'required',
                'duration' => 'required'
            ], [
                'name.required' => 'Name is required',
                'details.required' => 'You can not left details empty. Please add someting to describe plan',
                'price.required' => 'You can not left price empty.',
                'currency.required' => 'You can not left currency empty.',
                'duration.required' => 'Please select one duration.'
            ]);
    	DB::beginTransaction();
    	try {
            //dd($postData);
        	$data = array(
        			'name' => $postData['name'],
        			'details' => $postData['details'],
        			'price' => $postData['price'],
        			'currency_id' => $postData['currency'],
        			'duration' => $postData['duration'],
        			'updated_at' => date('Y-m-d H:i:s')

        	);
        	
			$record = Membership_plan::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	
        	return redirect('admin/membershipplan/list')->with('status', 'success')->with('message', 'Membership plan Updated Successfully');
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Membership_plan::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Membership plan Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();

        $membershipplan = Membership_plan::find($getData['g']);
        $membershipplan->status = $getData['s'];
        $membershipplan->save();

        return redirect()->back()->with('status', 'success')->with('message', 'Membership plan Status Changed Successfully');

    }
}
