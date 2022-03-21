<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();
Route::get('/search', 'ProfileController@search');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => ['can:all user']], function () {
    Route::get('profile/list', 'ProfileController@index'); 
});
    Route::get('profile/{id}/details', 'ProfileController@details'); 
    Route::get('profile/{id}/edit', 'ProfileController@edit'); 
    Route::post('profile/update', 'ProfileController@update'); 
    Route::group(['middleware' => ['can:delete user']], function () {
    Route::get('profile/{id}/delete', 'ProfileController@destroy');
});
    Route::get('post/list', 'PostController@index');
    Route::get('post/create', 'PostController@create');  
    Route::post('post/insert', 'PostController@insert');  
    Route::get('post/{id}/details', 'PostController@details');

    Route::get('post/{id}/edit', 'PostController@edit'); 
    Route::post('post/update', 'PostController@update'); 
    Route::get('post/{id}/delete', 'PostController@destroy');

});