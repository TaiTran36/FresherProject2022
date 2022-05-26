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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\Client\HomepageController::class, 'index'])->name('post.view');

Route::get('/search/user/{key}', [App\Http\Controllers\Client\SearchController::class, 'searchUser'])->name('search.user');
Route::get('/search/category/{key}', [App\Http\Controllers\Client\SearchController::class, 'searchCategory'])->name('search.category');
Route::get('/search/post/{key}', [App\Http\Controllers\Client\SearchController::class, 'searchPost'])->name('search.post');

Route::get('/category/{category}', [App\Http\Controllers\Client\HomepageController::class, 'showByCategory'])->name('category.show');
// Route::get('category/{url}/like', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
// Route::post('category/{url}/like', [App\Http\Controllers\Client\LikeController::class, 'like'])->name('like');
// Route::get('category/{url}/dislike', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
// Route::post('category/{url}/dislike', [App\Http\Controllers\Client\LikeController::class, 'like'])->name('like');
// Route::get('category/{url}', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
// Route::post('category/{url}', [App\Http\Controllers\Client\CommentController::class, 'store'])->name('comment.store');

Route::get('detail/{url}/comment/{id}', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
Route::post('detail/{url}/comment/{id}', [App\Http\Controllers\Client\CommentController::class, 'more'])->name('listComment');
Route::get('detail/{url}/comment/{id}/edit', [App\Http\Controllers\Client\CommentController::class, 'edit'])
    ->name('post.read');
Route::put('detail/{url}/comment/{id}', [App\Http\Controllers\Client\CommentController::class, 'update'])
    ->name('listComment'); 
Route::delete('detail/{url}/comment/{id}', [App\Http\Controllers\Client\CommentController::class, 'destroy'])->name('listComment');

Route::get('detail/{url}/like', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
Route::post('detail/{url}/like', [App\Http\Controllers\Client\LikeController::class, 'like'])->name('like');
Route::get('detail/{url}/dislike', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
Route::post('detail/{url}/dislike', [App\Http\Controllers\Client\LikeController::class, 'like'])->name('like');
Route::post('detail/{url}/comment', [App\Http\Controllers\Client\CommentController::class, 'store'])->name('addComment');

Route::get('detail/{url}', [App\Http\Controllers\Client\PostController::class, 'read'])->name('post.read');
Route::post('detail/{url}', [App\Http\Controllers\Client\CommentController::class, 'store'])->name('comment.store');

Route::get('user/{username}/post/follow', [App\Http\Controllers\Client\PostController::class, 'showPostOfAnUser'])->name('user.post.show');
Route::post('user/{username}/post/follow', [App\Http\Controllers\Client\FollowController::class, 'follow'])->name('user.post.show');
Route::get('user/{username}/post', [App\Http\Controllers\Client\PostController::class, 'showPostOfAnUser'])->name('user.post.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class,'showResetPassword'])->name('password.request');
Route::post('/passwords/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'sendMail'])->name('password.email');

Route::get('/user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'show'])->name('profile');
Route::post('/user/profile', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile'); 

Route::get('manage/post', [App\Http\Controllers\Admin\PostController::class, 'index'])->name('post.search');  
Route::get('manage/post/create', [App\Http\Controllers\Admin\PostController::class, 'create'])->name('post.create'); 
Route::get('manage/post/{url}', [App\Http\Controllers\Admin\PostController::class, 'show'])->name('post.show');
Route::post('manage/post', [App\Http\Controllers\Admin\PostController::class, 'store'])->name('post.store'); 
Route::get('manage/post/{url}/edit', [App\Http\Controllers\Admin\PostController::class, 'edit'])
    ->name('post.edit');
Route::put('manage/post/{url}', [App\Http\Controllers\Admin\PostController::class, 'update'])
    ->name('post.update');   
Route::delete('manage/post/{id}', [App\Http\Controllers\Admin\PostController::class, 'destroy'])->name('post.destroy');

Route::get('manage/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user.search');
Route::get('manage/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('user.show');
Route::get('manage/user/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])
    ->name('user.edit');
Route::put('manage/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])
    ->name('user.update'); 
Route::delete('manage/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');

Route::get('manage/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category.index');
Route::get('manage/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');
Route::post('manage/category', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('category.store');
// Route::get('manage/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('category.show');
Route::get('manage/category/{id}/edit', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])
    ->name('category.edit');
Route::put('manage/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])
    ->name('category.update'); 
Route::delete('manage/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::get('/demo', [App\Http\Controllers\DemoController::class, 'show'])->name('demo');
