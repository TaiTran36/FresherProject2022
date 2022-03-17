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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class,'showResetPassword'])->name('password.request');
Route::post('/passwords/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'sendMail'])->name('password.email');

Route::get('/user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'show'])->name('profile');
Route::post('/user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile'); 

Route::get('post', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('post.search'); 
Route::get('post/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('post.add'); 
Route::post('post/create', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('post.add'); 
Route::get('post/{id}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])
    ->name('post.edit');
Route::put('post/{id}', [App\Http\Controllers\Admin\PostController::class, 'update'])
    ->name('post.update');   

Route::get('user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.search');
Route::get('user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.add'); 
Route::post('user/create', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.add'); 
Route::get('user/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])
    ->name('user.edit');
Route::put('user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])
    ->name('user.update'); 

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
