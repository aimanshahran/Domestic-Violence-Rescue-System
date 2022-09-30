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

Auth::routes(['verify' => true]); // Helper class that helps to generate all the routes required for user authentication


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
