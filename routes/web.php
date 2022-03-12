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

Route::get('/user/profile', [App\Http\Controllers\Auth\User\ProfileController::class, 'show'])->name('profile');
Route::post('/user/profile', [App\Http\Controllers\Auth\User\ProfileController::class, 'update'])->name('profile'); 

Route::get('admin/user-list', [App\Http\Controllers\Auth\User\ListUserController::class, 'getUsers'])->name('user.search'); 

// Route::get('/admin/post-list', [App\Http\Controllers\Auth\User\ListPostController::class, 'getPosts'])->name('post.search');
// Route::post('/admin/post-list/{title}', [App\Http\Controllers\Auth\User\ListPostController::class, 'getDetailPost'])->name('post.search');

// Route::get('user/add-post', [App\Http\Controllers\Auth\User\PostController::class, 'show'])->name('post.add');
// Route::post('user/add-post', [App\Http\Controllers\Auth\User\PostController::class, 'insert'])->name('post.add');

// Route::('edit-post')
// Route::post('user/edit-post', [App\Http\Controllers\Auth\User\PostController::class, 'update'])->name('post.edit');

Route::resource('post', App\Http\Controllers\Auth\PostController::class)
    ->except(['index', 'search'])
    ->names([
        // 'index' => 'post.search', 
        'create' => 'post.add',
    ])
    ->parameters([
        'post' => 'post:title',
    ]);

Route::get('post', [App\Http\Controllers\Auth\PostController::class, 'index'])
    ->name('post.search');

Route::get('post-search', [App\Http\Controllers\Auth\PostController::class, 'search'])->name('post.search');

Route::get('user', [App\Http\Controllers\Auth\UserController::class, 'index'])
    ->name('user.search');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
