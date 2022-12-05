<?php

use App\Http\Controllers\FeedbackController;
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
Route::view('/loginemail', 'Auth/loginemail')->name('loginemail');
Route::view('/dvinfo', 'dv-information/dvinfo')->name('dvinfo');

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

/*User must login to access page*/
Route::middleware(['CheckRole:AllUser'])->group(function (){
    Route::get('manageprofile', 'App\Http\Controllers\Auth\ManageProfileController@index')->name('manage-profile');
    Route::post('manageprofile/profile','App\Http\Controllers\Auth\ManageProfileController@edit')->name('manage-profile.edit');
    Route::post('manageprofile/password','App\Http\Controllers\Auth\ManageProfileController@editpassword')->name('manage-profile.editpassword');
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
});

//User
Route::prefix('user')->middleware(['CheckRole:User'])->group(function (){
    Route::resource('feedback', FeedbackController::class, [
        'only' => ['create', 'store']
    ]);
});
