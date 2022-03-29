<?php

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

Route::get('/', function () {
    return view('welcomeOld');
});

// Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
// Route::get('/{link}', [App\Http\Controllers\WelcomeController::class, 'read'])->name('post.read');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class,'showResetPassword'])->name('password.request');
Route::post('/passwords/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'sendMail'])->name('password.email');

Route::get('/user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'show'])->name('profile');
Route::post('/user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile'); 

Route::get('post', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('post.search');  
Route::get('post/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('post.create'); 
Route::get('post/{url}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('post.show');
Route::post('post', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('post.store'); 
Route::get('post/{url}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])
    ->name('post.edit');
Route::put('post/{url}', [App\Http\Controllers\Admin\PostController::class, 'update'])
    ->name('post.update');   
Route::delete('post/{id}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('post.destroy');

Route::get('user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.search');
Route::get('user/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('user.show');
Route::get('user/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])
    ->name('user.edit');
Route::put('user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])
    ->name('user.update'); 
Route::delete('user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::get('/demo', [App\Http\Controllers\DemoController::class, 'show'])->name('demo');
