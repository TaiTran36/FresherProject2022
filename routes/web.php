<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Http\Controllers\NewsLetterController;
use App\Mail\OrderShipped;
use App\Http\Controllers\Ajax;
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

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('index', function () {
    return view('Home/index');
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
Route::get('category/{categories}/posts', 'App\Http\Controllers\WelcomeController@post_by_cate');
Route::get('{id}/{username}/posts', 'App\Http\Controllers\WelcomeController@post_by_user');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('post/{url}/detail_post', 'App\Http\Controllers\PostController@detail_post');


Route::group(['middleware' => 'auth'], function () {
    Route::post('post/save_comment','App\Http\Controllers\PostController@save_comment');
    Route::get('post/like','App\Http\Controllers\PostController@like');
    Route::get('post/dislike','App\Http\Controllers\PostController@dislike');

Route::group(['middleware' => ['can:all user']], function () {
    Route::get('profile/list', 'App\Http\Controllers\ProfileController@index'); });
    Route::get('profile/{id}/details', 'App\Http\Controllers\ProfileController@details'); 
    Route::get('profile/{id}/edit', 'App\Http\Controllers\ProfileController@edit'); 
    Route::post('profile/update', 'App\Http\Controllers\ProfileController@update'); 
    Route::group(['middleware' => ['can:delete user']], function () {
    Route::get('profile/{id}/delete', 'App\Http\Controllers\ProfileController@destroy');
    
});
    Route::get('permission/list', 'App\Http\Controllers\ProfileController@permission');

    Route::get('post/list', 'App\Http\Controllers\PostController@index');
    Route::get('post/create', 'App\Http\Controllers\PostController@create');  
    Route::post('post/insert', 'App\Http\Controllers\PostController@insert');  
    Route::get('post/{url}/details', 'App\Http\Controllers\PostController@details');
    Route::get('post/{url}/edit', 'App\Http\Controllers\PostController@edit'); 
    Route::post('post/update', 'App\Http\Controllers\PostController@update'); 
    Route::get('post/{url}/delete', 'App\Http\Controllers\PostController@destroy');
    Route::post('subscribe', 'App\Http\Controllers\NewsLetterController@subscribe');
    Route::post('subscribed', 'App\Http\Controllers\NewsLetterController@subscribed');
    Route::post('unsubscribed', 'App\Http\Controllers\NewsLetterController@unsubscribed');
    Route::post('tattb', 'App\Http\Controllers\NewsLetterController@tattb');
    Route::post('battb', 'App\Http\Controllers\NewsLetterController@battb');
Route::group(['prefix' => 'ajax'],function(){
    
    Route::post('/comment', [AjaxLoginController::class, 'comment'])->name('ajax.comment');

    });
    
});
  






