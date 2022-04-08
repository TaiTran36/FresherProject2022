<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class,'logout']);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth');

    Route::get('admin/delete/{id}', [App\Http\Controllers\AdminUserController::class, 'delete'])->name('delete_user');

    Route::get('admin/edit/{id}', [App\Http\Controllers\AdminUserController::class, 'edit'])->name('admin.edit');

    Route::post('admin/update/{id}', [App\Http\Controllers\AdminUserController::class, 'update'])->name('admin.update');

    Route::get('admin/show/{id}', [App\Http\Controllers\AdminUserController::class, 'show'])->name('admin.show');

    Route::post('admin/search', [App\Http\Controllers\AdminUserController::class, 'search'])->name('admin.search');

    Route::get('post/add', [App\Http\Controllers\PostController::class, 'add'])->name('post.add');

    Route::post('post/store', [App\Http\Controllers\PostController::class, 'store']);

    Route::get('post/list', [App\Http\Controllers\PostController::class, 'list'])->name('post.list');

    Route::get('post/delete/{id}', [App\Http\Controllers\PostController::class, 'delete'])->name('delete_post');

    Route::get('post/edit/{post_url}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

    Route::post('post/update/{id}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');


    Route::get('post/{post_url}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');

    Route::post('post/search', [App\Http\Controllers\PostController::class, 'search'])->name('post.search');
    //Admin Login
    
});
Route::post('adminLogin', [App\Http\Controllers\AdminController::class, 'adminLogin'])->name('adminLogin');

//client
Route::get('post/{post_url}/details', [App\Http\Controllers\PostController::class, 'index']);
