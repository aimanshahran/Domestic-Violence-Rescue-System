<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use App\Mail\EmergencyNotification;
use App\Models\EmergencyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use App\Models\User;
use DB;
use App\Http\Requests;

class EmergencyController extends Controller
{
    public function index()
    {
        return view ('emergency.index');
    }

    public function create()
    {
        return view('emergency.create');
    }

    public function store(Request $request)
    {
        //VALIDATE USER INPUT BEFORE INSERT INTO DATABASE
        $request->validate([
            'details' => 'required|alpha_spaces|max:255',
        ]);

        //INSERT DATA TO DATABASE
        $emergency=Emergency::create();
        $emergency->longitude = $request['long'];
        $emergency->latitude = $request['lat'];
        $emergency->details = $request['details'];
        $emergency->severity_status = 1;

        if($emergency->save()){

            $files = [];
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $file)
                {
                    $name = time().rand(1,100).'.'.$file->extension();
                    $file->move(public_path('/img/uploads'), $name);
                    $files[] = $name;
                }
            }

            $file = new EmergencyPhoto();
            $file->filenames = $files;
            $file->case_id = $emergency->id;
            $file->save();

            $admin = User::select(
                'email')
                ->where('role_id', '=', '1')
                ->get();

            foreach($admin as $a) {
                Mail::to($a->email)->send(new EmergencyNotification());
            }

            return redirect()->route('emergency-status')->with('success', 'success');
        }else{
            return redirect()->route('emergency-status')->with('unsuccessful', 'unsuccessful');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    protected function sendSMS(Request $request){
        if (Auth::check()) {
            // CREATE OTP CODE
            $code = rand(100000, 999999);
            $receiverNumber = '+60'.Auth::user()->phone;
            $message = "DVRS: This is your code: ". $code . "\nNEVER share this code with others, including our staff.\nPlease delete this message after use.";

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
            return redirect()->route('emergency-verify-phone.verify')->with(['phone' => $request->phone]);
        }else{
            //VALIDATE USER INPUT BEFORE SEND SMS
            $request->validate([
                'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|unique:users',
            ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.']);

            // CREATE OTP CODE
            $code = rand(100000, 999999);
            $receiverNumber = '+60'.$request['phone'];
            $message = "DVRS: This is your code: ". $code . "\nNEVER share this code with others, including our staff.\nPlease delete this message after use.";

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
            return redirect()->route('emergency-verify-phone.verify')->with(['phone' => $request->phone]);
        }
    }

    protected function verifyPhone(Request $request)
    {
        $OTP = $request->session()->get('OTP');
        $inputOTP = $request['first'].$request['second'].$request['third'].$request['fourth'].$request['fifth'].$request['sixth'];

        if ($OTP==$inputOTP) {
            return redirect()->route('emergency.create')->with(['phone' => $request->phone]);
        }
        return back()->with(['phone' => $request->phone, 'unsuccessful' => 'Wrong OTP.'.$OTP]);
    }
}
