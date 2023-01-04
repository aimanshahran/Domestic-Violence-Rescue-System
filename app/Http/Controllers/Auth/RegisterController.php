<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Twilio\Rest\Client;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|alpha_spaces|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
                'confirmed'
            ],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
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
        return redirect()->route('verify-phone')->with(['phone' => $request->phone]);
    }

    protected function verifyPhone(Request $request)
    {
        $OTP = $request->session()->get('OTP');
        $inputOTP = $request['first'].$request['second'].$request['third'].$request['fourth'].$request['fifth'].$request['sixth'];

        if ($OTP==$inputOTP) {
            return redirect()->route('register')->with(['phone' => $request->phone]);
        }
        return back()->with(['phone' => $request->phone, 'unsuccessful' => 'Wrong OTP.']);
    }

}
