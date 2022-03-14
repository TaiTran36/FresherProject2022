<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('admin/login', function () {
    return view('admin.login');
});

Route::post('/admin/login', [AdminController::class, 'loginPost'])->name('admin.loginPost');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware(['admin'])->group(function (){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/statistic', [AdminController::class, 'statistic'])->name('admin.statistic')->middleware('admin');
});


Route::get('profile', 'App\Http\Controllers\ProfileController@index'); 
Route::get('profile/{id}/details', 'App\Http\Controllers\ProfileController@details'); 
Route::get('profile/{id}/edit', 'App\Http\Controllers\ProfileController@edit'); 
Route::post('profile/update', 'App\Http\Controllers\ProfileController@update'); 
Route::get('profile/{id}/delete', 'App\Http\Controllers\ProfileController@destroy');


Route::get('post', 'App\Http\Controllers\PostController@index'); 
Route::get('post/{id}/details', 'App\Http\Controllers\PostController@details'); 
Route::get('post/{id}/edit', 'App\Http\Controllers\PostController@edit'); 
Route::post('post/update', 'App\Http\Controllers\PostController@update'); 
Route::get('post/{id}/delete', 'App\Http\Controllers\PostController@destroy');