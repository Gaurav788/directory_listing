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
	
    public function reply(Request $request){
        return view('admin.contactus.reply_back');
    }
	
    public function del_record(Request $request){
        try {
            Contact::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Information Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();

        $contact = Contact::find($getData['g']);
        $contact->status = $getData['s'];
        $contact->save();

        return redirect()->back()->with('status', 'success')->with('message', 'Info Status Changed Successfully');

    }
}
