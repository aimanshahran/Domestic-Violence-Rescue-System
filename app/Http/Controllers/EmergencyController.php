<?php

namespace App\Http\Controllers;

use App\Exports\EmergencyExport;
use App\Models\CaseCategory;
use App\Models\CaseStatus;
use App\Models\Emergency;
use App\Mail\EmergencyNotification;
use App\Models\EmergencyCategory;
use App\Models\EmergencyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Twilio\Rest\Client;
use App\Models\User;
use DB;
use App\Http\Requests;

class EmergencyController extends Controller
{
    public function index()
    {
        if( Auth::user() && (((Auth::user()->role_id)==1) || ((Auth::user()->role_id)==5))) {
            $emergencies = Emergency::select(
                'emergency.id', 'users.name AS name', 'emergency.phone', 'emergency.longitude', 'emergency.latitude',
                'emergency.details', 'emergency.severity_status', 'emergency.status', 'emergency.remarks')
                ->leftjoin('users', 'emergency.user_id', '=', 'users.id')
                ->orderBy('emergency.created_at', 'DESC')
                ->whereNot('emergency.status', '=', '10')
                ->paginate(5);

            if (!$emergencies) {
                abort(404);
            }
            return view ('emergency.welcome', compact('emergencies'));
        }

        return view ('emergency.index');
    }

    public function create()
    {
        $category = CaseCategory::all();
        return view('emergency.create', compact('category'));
    }

    public function store(Request $request)
    {
        //VALIDATE USER INPUT BEFORE INSERT INTO DATABASE
        $request->validate([
            'details' => 'required|max:255',
        ]);

        $severity = min($request['category']);

        if ($severity < 11){
            $severity = 3;
        }elseif ($severity < 16){
            return redirect()->route('emergency-status')->with('misuse', 'unsuccessful');
        }else{
            return redirect()->route('emergency-status')->with('misuse', 'unsuccessful');
        }

        //INSERT DATA TO DATABASE
        $emergency=Emergency::create();
        $emergency->phone = $request['phone'];
        $emergency->longitude = $request['long'];
        $emergency->latitude = $request['lat'];
        $emergency->details = $request['details'];
        $emergency->severity_status = $severity;

        if($emergency->save()){

            // SAVE CATEGORY TO DATABASE
            $category = new EmergencyCategory();

            foreach ($request->input('category') as $categories) {

                $category::create([
                    'emergency_id'     => $emergency->id,
                    'case_category_id' => $categories
                ]);
            }

            // SAVE PHOTO TO DATABASE

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $name = time().rand(1,100).'.'.$file->extension();
                    $file->move(public_path('/img/uploads'), $name);
                    $data = new EmergencyPhoto();
                    $data->photo_name = str_replace('"', "", $name);
                    $data->emergency_id = $emergency->id;
                    $data->save();
                }
            }

            $admin = User::select(
                'email', 'phone')
                ->where('role_id', '=', '1')
                ->get();

            foreach($admin as $a) {
                Mail::to($a->email)->send(new EmergencyNotification());
                $receiverNumber = '+60'.$a->phone;
                $message = "DVRS: [ALERT] Emergency Notification. Please check in the system.";

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
            }

            return redirect()->route('emergency-status')->with('success', 'success');
        }else{
            return redirect()->route('emergency-status')->with('unsuccessful', 'unsuccessful');
        }
    }

    public function show(Emergency $emergency)
    {
        //return view('emergency.show', compact('emergency'));
    }

    public function edit($id)
    {
        $emergency = Emergency::all()->find($id);
        $category = EmergencyCategory::where('emergency_id', '=', $id)->get();
        $statusCategory = CaseStatus::where('id', '!=', '10')->get();
        $photo = EmergencyPhoto::where('emergency_id', '=', $id)->get('photo_name');
        return view('emergency.edit', compact('emergency', 'category', 'photo', 'statusCategory'));
    }

    public function update(Request $request, Emergency $emergency)
    {
        $request->validate([
            'status' => 'required',
            'remarks' => ['string', 'max:255', 'nullable']
        ]);

        $update = $emergency->fill($request->post())->save();

        if($update)
            return redirect()->back()->with('success','Emergency updated successfully');
        else
            return redirect()->back()->with('unsuccessful','An error occurred. Please contact administrator.');
    }

    public function destroy(Emergency $emergency)
    {
        if ($emergency->status == 9) {
            $emergency->status = 10;
            $archive = $emergency->save();

            if ($archive){
                return redirect()->back()->with('success','Case archived.');
            }else{
                return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');
            }
        }else{
            return redirect()->back()->with('unsuccessful','Only case with settle status can be archived.');
        }
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
            ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.',
                'phone.unique' => 'This :attribute number has already been registered. Please login to use this function.']);

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
        return back()->with(['phone' => $request->phone, 'unsuccessful' => 'Wrong OTP.']);
    }

    protected function manageEmergency(){
        $emergencies = Emergency::select(
            'emergency.id', 'emergency.created_at', 'emergency.longitude', 'case_status.name', 'emergency.remarks')
            ->leftjoin('users', 'emergency.user_id', '=', 'users.id')
            ->leftjoin('case_status', 'emergency.status', '=', 'case_status.id')
            ->where('emergency.phone', '=', Auth::user()->phone)
            ->orderBy('emergency.created_at', 'DESC')
            ->limit(1)
            ->get();

        if (!$emergencies) {
            abort(404);
        }

        return view ('emergency.manageemergency', compact('emergencies'));
    }

    public function exportProductDatabase()
    {
        $timestamp = time();
        $filename = 'emergency_archive_' . $timestamp;

        return Excel::download(new EmergencyExport, $filename.'.xlsx');
    }
}
