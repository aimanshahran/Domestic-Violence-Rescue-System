<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
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
        //
    }

    public function store(Request $request)
    {
        //
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
        //VALIDATE USER INPUT BEFORE SEND SMS
        $request->validate([
            'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|unique:users',
        ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.']);

        // CREATE OTP CODE
        $code = rand(100000, 999999);
        $receiverNumber = '+60'.$request['phone'];
        $message = "Hi! Welcome to DVRS! This is your code: ". $code . " NEVER share this code with others, including our staff.";

        /*try {
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
        }*/

        session(['OTP' => $code]);
        return redirect()->route('emergency-verify-phone.verify')->with(['phone' => $request->phone]);
    }

    protected function verifyPhone(Request $request)
    {
        $OTP = $request->session()->get('OTP');
        $inputOTP = $request['first'].$request['second'].$request['third'].$request['fourth'].$request['fifth'].$request['sixth'];

        if ($OTP==$inputOTP) {
            //return redirect()->route('register')->with(['phone' => $request->phone]);
            return back();
        }
        return back()->with(['phone' => $request->phone, 'unsuccessful' => 'Wrong OTP.'.$OTP]);
    }
}
