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
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    return view('index');
});

Route::resource('feedback', FeedbackController::class, [
    'only' => ['index']
])->middleware('auth');

//Admin
Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function (){
    Route::resource('feedback', FeedbackController::class, [
        'except' => ['create', 'store', 'index']
    ]);
});

//User
Route::prefix('user')->middleware(['auth','isUser'])->group(function (){
    Route::resource('feedback', FeedbackController::class, [
        'only' => ['create', 'store']
    ]);
});

Route::get('manageprofile', 'App\Http\Controllers\Auth\ManageProfileController@index')->name('manage-profile')->middleware(['auth', 'password.confirm']);
Route::post('manageprofile/profile','App\Http\Controllers\Auth\ManageProfileController@edit')->name('manage-profile.edit');
Route::post('manageprofile/password','App\Http\Controllers\Auth\ManageProfileController@editpassword')->name('manage-profile.editpassword');
Route::view('/loginemail', 'Auth/loginemail')->name('loginemail');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
