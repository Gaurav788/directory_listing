<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testimonial;
use DB;

class TestimonialsController extends Controller
{
    //
    //
    public function list_records(Request $request){
        $data = Testimonial::get();
        return view('admin.testimonials.list', compact('data'));
    }
	
    public function del_record(Request $request){
        try {
            Testimonial::where('id',$request->input('id'))->delete();
            return response()->json(["success"=>true,"msg"=>"Testimonial Deleted Successfully"],200);
        }catch(Exception $ex){
            return redirect()->back()->with('status', 'error')->with('message', $ex->getMessage());
        }
    }

    public function change_status(Request $request){
        $getData = $request->all();

        $testimonial = Testimonial::find($getData['g']);
        $testimonial->status = $getData['s'];
        $testimonial->save();

        return redirect()->back()->with('status', 'success')->with('message', 'Testimonial Status Changed Successfully');

    }
}
