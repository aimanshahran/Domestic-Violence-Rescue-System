<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Mail\RegisterNotification;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{

    public function index()
    {
        $users = User::all()->except(Auth::user()->id);
        return view('manage-user.index', compact('users'));
    }

    public function create()
    {
        $genders = Gender::get();
        $roles = Role::all();
        return view('manage-user.create', compact('genders', 'roles'));
    }

    public function store(Request $request)
    {
        /*VALIDATE DATA BEFORE SAVE TO DATABASE*/
        $request->validate([
            'name' => 'required|alpha_spaces|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|unique:users',
            'gender_id' => 'required|not_in:0',
            'role_id' => 'required|not_in:0',
            ['phone.regex' => 'The :attribute number must be a valid :attribute number.']]);

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);
        $request->request->add(['password' => Hash::make($password)]);

        $register = User::create($request->all());

        if ($register){
            Mail::to($request['email'])->send(new RegisterNotification($request));
            return redirect()->route('manage-user.index')->with('success','The user has been added');
        }else {
            return redirect()->route('manage-user.index')->with('unsuccessful','An error occurred. Please contact administrator.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user, $id)
    {
        $gender = Gender::all();
        $roles = Role::all();
        $user = $user->find($id);

        return view('manage-user.edit', compact('user', 'gender', 'roles'));
    }

    public function update(User $user, Request $request, $id)
    {
        $user = $user->find($id);
        switch ($request->input('action')) {
            case 'reset':
                $response = Password::broker()->sendResetLink(['email'=>$user->email]);
                if($response)
                    return redirect()->route('manage-user.edit', $id)->with('success1','The reset password link have been emailed to user email.');
                else
                    return redirect()->route('manage-user.edit', $id)->with('unsuccessful1','An error occurred. Please contact administrator.');
            case 'verify':
                $user->email_verified_at = null;
                $user->sendEmailVerificationNotification();
                return redirect()->route('manage-user.edit', $id)->with('success1','The new verification email have been sent to user email.');
            case 'save':
                //VALIDATE USER INPUT BEFORE INSERT INTO DATABASE
                $request->validate([
                    'name' => 'required|alpha_spaces|max:255',
                    'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                    'phone' => 'required|regex:/^(1)[0-46-9]-*[0-9]{7,8}$/|numeric|' . Rule::unique('users', 'phone')->ignore($user->id),
                    'gender_id' => "required|in:1,2",
                    'role_id' => 'required|in:1,2,3,4,5',
                ], ['phone.regex' => 'The :attribute number must be a valid :attribute number.']);

                //INSERT DATA TO DATABASE
                $message = null;
                $user->name = $request['name'];
                $user->email = $request['email'];
                if ($user->isDirty('email')) {  //TO CHECK IF EMAIL CHANGED, IF YES, VERIFICATION EMAIL WILL BE SENT
                    $user->email_verified_at = null;
                    $user->sendEmailVerificationNotification();
                    $message = 'System already sent user an email to verify the email.';
                }
                $user->phone = $request['phone'];
                $user->gender_id = $request['gender_id'];
                $user->role_id = $request['role_id'];
                if($user->save()){
                    return redirect()->route('manage-user.edit', $id)->with('success', 'User profile is updated. '.$message);
                }else{
                    return redirect()->route('manage-user.edit', $id)->with('unsuccessful', 'There is an error occurred. Please contact administrator');
                }
        }
    }

    public function destroy($id)
    {
        $delete = User::find($id)->delete();

        if ($delete){
            return redirect()->back()->with('success','User has been removed.');
        }

        return redirect()->back()->with('unsuccessful','There is an error occurred. Please contact administrator');
    }
}
