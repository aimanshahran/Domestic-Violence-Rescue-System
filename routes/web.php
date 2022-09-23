<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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
    return view('welcome');
});

Route::view('/loginemail', 'Auth/loginemail')->name('loginemail');
Route::view('manageprofile', 'manage-profile')->name('manage-profile')->middleware('auth');
Route::view('feedback', 'feedback')->name('feedback')->middleware('auth');
Route::post('feedback','App\Http\Controllers\FeedbackController@insert')->name('feedback')->middleware('auth');
Route::get('managefeedback','App\Http\Controllers\FeedbackController@index')->name('manage-feedback')->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
