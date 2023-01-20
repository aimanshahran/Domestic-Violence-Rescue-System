<?php

use App\Http\Controllers\Auth\LoginOTPController;
use App\Http\Controllers\Auth\ManageProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DvinfoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\StatisticController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ALL USER
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function () {
    return view('index');
});

//LOGIN WITH OTP
Route::view('/loginotp', 'Auth/loginotp')->name('login-otp');
//TO SEND OTP TO THE USER AFTER CLICK CONFIRM PHONE NUMBER
Route::post('/loginotp', [LoginOTPController::class,'sendSMS'])->name('login-otp.verify');
//TO VERIFY OTP
Route::get('/loginotp-verify', function () {
    return view('auth/loginverifyphone');
})->name('login-otp.verify.verifyphone');
Route::post('/loginotp-verify', [LoginOTPController::class,'verifyPhone'])->name('login-otp.verifyphone');

Auth::routes(['verify' => true]); // Helper class that helps to generate all the routes required for user authentication

Route::get('/verify', function () {
    return view('auth.verify');
})->name('verify');

Route::get('/verifyphone', function () {
    return view('auth/verifyphone');
})->name('verify-phone');
Route::post('/verifyphone', [App\Http\Controllers\Auth\RegisterController::class,'verifyPhone'])->name('verify-phone.verify');

Route::get('/registerphone', function () {
    return view('auth/registerphone');
})->name('register-phone');
Route::post('/registerphone', [App\Http\Controllers\Auth\RegisterController::class,'sendSMS'])->name('register-phone.sms');

Route::singleton('dvinfo', DvinfoController::class, [
    'except' => ['edit', 'update'],
    'names' => ['show' =>'DV-Information.show']
]);

Route::resource('blog', BlogController::class, [
    'only' => ['index', 'show']
]);

Route::get('emergency/welcome', function () {
    return view('emergency/welcome');
})->name('emergency-welcome');

//TO SEND OTP TO THE USER AFTER CLICK CONFIRM PHONE NUMBER
Route::post('emergency/verifyemergency', [EmergencyController::class,'sendSMS'])->name('emergency.sms');

//SHOW FORM FOR USER TO KEY-IN OTP CODE
Route::get('emergency/verifyphoneemergency', function () {
    return view('emergency/verifyphone');
})->name('emergency-verify-phone');

//VERIFY OTP BASED ON 6 DIGIT CODE
Route::post('emergency/verifyphoneemergency', [EmergencyController::class,'verifyPhone'])->name('emergency-verify-phone.verify');

//SHOW STATUS AFTER SUBMIT REPORT
Route::get('emergency/success', function () {
    return view('emergency/status');
})->name('emergency-status');

Route::resource('emergency', EmergencyController::class, [
    'only' => ['index', 'create', 'store']
]);

Route::resource('statistic', StatisticController::class, [
    'only' => ['index']
]);

/*User must login to access page*/
Route::middleware(['CheckRole:AllUser'])->group(function (){
    Route::get('manageprofile', [ManageProfileController::class, 'index'])->name('manage-profile');
    Route::post('manageprofile/profile',[ManageProfileController::class, 'edit'])->name('manage-profile.edit');
    Route::post('manageprofile/password',[ManageProfileController::class, 'editpassword'])->name('manage-profile.editpassword');
    Route::post('manageprofile/destroy',[ManageProfileController::class, 'destroy'])->name('manage-profile.destroy');

    Route::resource('feedback', FeedbackController::class, [
        'only' => ['index']
    ]);

    Route::get('/email/verify', function () {
        return view('auth.verify');
    })->name('verification.notice');

    Route::get('/changephone', function () {
        return view('auth/changephonenumber');
    })->name('change-phone-number');
    Route::post('/changephone', 'App\Http\Controllers\Auth\ManageProfileController@editphone')->name('change-phone.sms');

    Route::get('/verifychangephone', function () {
        return view('auth/verifychangephone');
    })->name('verify-change-phone');
    Route::post('/verifychangephone', 'App\Http\Controllers\Auth\ManageProfileController@verifyPhone')->name('verify-change-phone.verify');
});

//Admin
Route::prefix('admin')->middleware(['CheckRole:Admin'])->group(function (){
    Route::resource('feedback', FeedbackController::class, [
        'except' => ['create', 'store', 'index']
    ]);

    Route::resource('manage-user', ManageUserController::class);

    Route::singleton('statistic', StatisticController::class, [
        'only' => ['show'],
        'names' => ['show' => 'statistic.show']
    ]);

    Route::resource('statistic', StatisticController::class, [
        'except' => ['index', 'show']
    ]);
});

//User
Route::prefix('user')->middleware(['CheckRole:User'])->group(function (){
    Route::resource('feedback', FeedbackController::class, [
        'only' => ['create', 'store']
    ]);
    //MANAGE EMERGENCY
    Route::get('emergency/manageemergency', [EmergencyController::class,'manageEmergency'])->name('manage-emergency');
});


Route::prefix('admin-writer')->middleware(['CheckRole:Admin-Writer'])->group(function (){

    Route::resource('/blog', BlogController::class, [
        'except' => ['index', 'show']
    ]);
});

Route::prefix('enhanced-user')->middleware(['CheckRole:Admin-Writer-Authorities'])->group(function (){
    Route::singleton('dvinfo', DvinfoController::class, [
        'only' => ['edit', 'update'],
        'names' => ['edit' =>'DV-Information.edit', 'update' =>'DV-Information.update']
    ]);
});

Route::prefix('admin-authorities')->middleware(['CheckRole:Admin-Authorities'])->group(function (){
    Route::resource('emergency', EmergencyController::class, [
        'except' => ['index', 'create', 'store']
    ]);

    Route::post('emergency/download', [EmergencyController::class,'exportProductDatabase'])->name('manage-emergency.download');
});
