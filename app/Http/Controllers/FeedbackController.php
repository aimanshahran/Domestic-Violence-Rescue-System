<?php

namespace App\Http\Controllers;
use App\Models\Feedback;
use DB;
use Illuminate\Http\Request;
use Auth;

class FeedbackController extends Controller
{
    public function index(){
        if((Auth::user()->role_id)==1){
            $feedbacks = Feedback::select(
                'feedback.id AS id', 'users.name AS name', 'users.email AS email', 'feedback.title AS title', 'feedback.details AS details', 'feedback_status.name AS status',
                'feedback.remark AS remark', 'feedback.created_at AS created_at')
                ->leftjoin('feedback_status', 'feedback.status', '=', 'feedback_status.id')
                ->leftjoin('users', 'feedback.user_id', '=', 'users.id')
                ->paginate(6);
        }else{
            $feedbacks = Feedback::select(
                'feedback.id AS id', 'users.name AS name', 'users.email AS email', 'feedback.title AS title', 'feedback.details AS details', 'feedback_status.name AS status',
                'feedback.remark AS remark', 'feedback.created_at AS created_at')
                ->leftjoin('feedback_status', 'feedback.status', '=', 'feedback_status.id')
                ->leftjoin('users', 'feedback.user_id', '=', 'users.id')
                ->where('user_id', '=', Auth::user()->id)
                ->paginate(6);
        }

        if (!$feedbacks) {
            abort(404);
        }

        return view('feedback.index',compact('feedbacks'));
    }

    public function create(){
        return view('feedback.create');
    }

    public function store(Request $request){
        /*VALIDATE DATA BEFORE SAVE TO DATABASE*/
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:20'],
            'details' => ['required', 'string', 'min:3', 'max:255']
        ]);

        /*SAVE TO DATABASE*/
        $insert = Feedback::create($request->all());

       /*DISPLAY SUCCESS AND ERROR MESSAGE*/
        if($insert){
            $status = 'success';
            $message = 'Your feedback is well received. ';
        }else{
            $status = 'unsuccessful';
            $message = 'There is an error occurred. Please contact administrator';
        }

        /*RETUREN TO MAIN FORM PAGE*/
        return redirect()->route('feedback.create')->with($status, $message);
    }

    public function show(Feedback $feedback){
        return view('feedback.index',compact('feedback'));
    }

    public function edit(Feedback $feedback){
        $feedback->load('user');

        return view('feedback.edit',compact('feedback'));
    }

    public function update(Request $request, Feedback $feedback){
        $request->validate([
            'status' => 'required|not_in:0',
            'remark' => ['string', 'max:255', 'nullable']
        ]);

        $feedback->fill($request->post())->save();

        return redirect()->back()->with('success','Feedback updated successfully');
    }
}
