<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use DB;

class ContactUsController extends Controller
{
    //
    public function list_records(Request $request){
        $data = Contact::get();
        return view('admin.contactus.list', compact('data'));
    }
	
    public function reply($id){
		$data = Contact::find($id);
        return view('admin.contactus.reply_back', compact('data'));
    }

    public function replied(Request $request){
        $postData = $request->all();
		$id =$postData['edit_record_id'];
		$request->validate([
                'fromemail' => 'required|email',
                'subject' => 'required',
                'reply_message' => 'required'
            ], [
                'fromemail.required' => 'From email is required',
                'subject.required' => 'You can not left subject empty. Please add someting to describe your reply',
                'reply_message.required' => 'You can not left reply message empty. Please add someting to your reply'
            ]);
    	DB::beginTransaction();
    	try {
            //dd($postData);
        	$data = array(
        			'reply_subject' => $postData['subject'],
        			'reply_message' => $postData['reply_message'],
        			'replied_on' => date('Y-m-d H:i:s'),
        			'updated_at' => date('Y-m-d H:i:s')

        	);
        	
			$record = Contact::where('id', $postData['edit_record_id'])->update($data);
			DB::commit();
        	
        	return redirect('admin/contactus/list')->with('status', 'success')->with('message', 'Reply Updated Successfully');
        	
        } catch ( \Exception $e ) {
            DB::rollback();
            //dd($e);
            return redirect()->back()->with('status', 'error')->with('message', $e->getMessage());
        }
    }
	
    public function del_record(Request $request){
        try {
            Contact::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Information Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }
}
