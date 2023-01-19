<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class LoginOTPController extends Controller
{
    protected function sendSMS(Request $request){
            //VALIDATE USER INPUT BEFORE SEND SMS
            $request->validate([
                'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|exists:users,phone',
            ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.',
                'phone.exists' => 'Account does not exist. Please register to log in.']);

            // CREATE OTP CODE
            $code = rand(100000, 999999);
            $receiverNumber = '+60'.$request['phone'];
            $message = "DVRS: This is your login code: ". $code . "\nNEVER share this code with others, including our staff.";

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
            return redirect()->route('login-otp.verifyphone')->with(['phone' => $request->phone]);
    }

    protected function verifyPhone(Request $request)
    {
        $OTP = $request->session()->get('OTP');
        $inputOTP = $request['first'].$request['second'].$request['third'].$request['fourth'].$request['fifth'].$request['sixth'];

        if ($OTP==$inputOTP) {
            $user = User::where('phone', $request->phone)->first();
            Auth::login($user);
            return redirect('/home');
        }
        return back()->with(['phone' => $request->phone, 'unsuccessful' => 'Wrong OTP.']);
    }
}
