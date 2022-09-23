<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{
    //
    public function insertform(){
        return view('feedback');
    }

    public function index(){
        $roleID = Auth::user()->role_id;
        $userId = Auth::user()->id;
        if ($roleID != '1'){
            $id = DB::table('feedback')
                ->selectRaw('feedback.id, feedback.user_id, feedback.title, feedback.details, feedback.created_at, feedback_status.name AS status')
                ->leftjoin('feedback_status', 'feedback.status', '=', 'feedback_status.id')
                ->where('user_id', '=', $userId)
                ->get();
        }else{
            $id = DB::table('feedback')
                ->selectRaw('feedback.id, feedback.user_id, feedback.title, feedback.details, feedback.created_at, feedback_status.name AS status')
                ->leftjoin('feedback_status', 'feedback.status', '=', 'feedback_status.id')
                ->get();
        }

        return view('manage-feedback',['id'=>$id]);
    }

    public function insert(Request $request){
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:20'],
            'details' => ['required', 'string', 'min:3', 'max:255']
        ]);

        $user_id = $request->input('id');
        $title = $request->input('title');
        $details = $request->input('details');
        $data=array('user_id'=>$user_id,"title"=>$title,"details"=>$details);
        try{
            DB::table('feedback')->insert($data);
            return redirect()->back()->with('success', 'Your feedback is well received.');
        }catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('unsuccessful', 'There is an error occurred. Please contact administrator');
        }
    }
}
