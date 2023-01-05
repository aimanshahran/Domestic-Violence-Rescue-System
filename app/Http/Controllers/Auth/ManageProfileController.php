<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;
use DB;
use Auth;
use Twilio\Rest\Client;

class ManageProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $gender = Gender::get();
        return view('manage-profile', compact('gender'));
    }

    public function edit(Request $request) {

        //VALIDATE USER INPUT BEFORE INSERT INTO DATABASE
        $request->validate([
            'name' => 'required|alpha_spaces|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|' . Rule::unique('users', 'phone')->ignore(Auth::user()->id),
            'gender' => "required|in:1,2",
        ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.']);

        //INSERT DATA TO DATABASE
        $message = null;
        $user =Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        if ($user->isDirty('email')) {  //TO CHECK IF EMAIL CHANGED, IF YES, VERIFICATION EMAIL WILL BE SENT
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
            $message = 'We sent you an email to verify your email.';
        }
        $user->gender_id = $request['gender'];

        if($user->save()){
            return redirect()->back()->with('success', 'Your profile is updated. '.$message);
        }else{
            return redirect()->back()->with('unsuccessful', 'There is an error occurred. Please contact administrator');
        }
    }

    protected function editphone(Request $request){
        //VALIDATE USER INPUT BEFORE SEND SMS
        $request->validate([
            'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|unique:users',
        ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.']);

        // CREATE OTP CODE
        $code = rand(100000, 999999);
        $receiverNumber = '+60'.$request['phone'];
        $message = "DVRS: You have requested to change your phone number. This is your code: ". $code . " NEVER share this code with others, including our staff.";

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            //$twilio_number = env("TWILIO_NUMBER");
            $twilio_messaging_sid = getenv("TWILIO_MESSAGING_SID");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                //'from' => $twilio_number,
                'messagingServiceSid' => $twilio_messaging_sid,
                'body' => $message]);

        } catch (Exception $e) {
            echo("Error: ". $e->getMessage());
        }

        session(['OTP' => $code]);
        return redirect()->route('verify-change-phone')->with(['phone' => $request->phone]);
    }

    protected function verifyPhone(Request $request)
    {
        $OTP = $request->session()->get('OTP');
        $inputOTP = $request['first'].$request['second'].$request['third'].$request['fourth'].$request['fifth'].$request['sixth'];

        if ($OTP==$inputOTP) {
                $user =Auth::user();
                $user->phone = $request['phone'];
                if($user->save()){
                    return redirect()->route('manage-profile')->with('success', 'Your phone number is updated.');
                }else{
                    return redirect()->route('manage-profile')->with('unsuccessful', 'There is an error occurred. Please contact administrator');
                }
        }
        return back()->with(['phone' => $request->phone, 'unsuccessful' => 'Wrong OTP.'.$OTP]);
    }

    protected function editpassword(Request $request) {

        //CHANGE ATTRIBUTES NAME TO DISPLAY A BETTER ERROR MESSAGE
        $attributes = [
            'oldpassword' => 'old password',
            'confirm' => 'confirm password',
            'newpassword' => 'new password',
        ];

        //VALIDATE PASSWORD INPUT BEFORE INSERT INTO DATABASE
        $request->validate([
            'oldpassword' => ['required', new MatchOldPassword], //CHECK IF THE PASSWORD SAME WITH OLD PASSWORD
            'newpassword' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
            ],
            'confirm' => ['required', 'same:newpassword'], //CHECK IF CONFIRM PASSWORD SAME WITH NEW PASSWORD
        ], [], $attributes);

        //INSERT NEW PASSWORD TO DATABASE
        $user =Auth::user();
        $user->password = Hash::make($request['newpassword']);

        if($user->save()){
            return redirect()->back()->with('success1', 'Your password is updated.');
        }else{
            return redirect()->back()->with('unsuccessful1', 'There is an error occurred. Please contact administrator');
        }
    }
}
