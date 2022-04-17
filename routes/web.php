<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;

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
Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('post/{url}/client_details', 'ClientController@client_details');
Route::get('post/{url}/client_details_comments', 'ClientController@client_details_comments'); //pagination comments
Route::get('category/{name}/posts', 'ClientController@post_by_cate');
Route::get('author/{username_login}/posts', 'ClientController@post_by_author');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => 'auth'], function () {
    Route::get('post/save-comment','ClientController@save_comment');
    Route::get('post/edit-comment','ClientController@edit_comment');
    Route::get('post/delete-comment','ClientController@delete_comment');
    Route::get('post/like','ClientController@like');
    Route::get('post/dislike','ClientController@dislike');
    Route::group(['middleware' => ['can:all user']], function () {
    Route::get('profile/list', 'ProfileController@index'); 
    Route::get('profile/search', 'ProfileController@search');
    Route::get('profile/search_all', 'ProfileController@search_results_all');
    Route::get('profile/get_list', 'ProfileController@get_list');
});
    Route::get('profile/{id}/details', 'ProfileController@details'); 
    Route::get('profile/{id}/edit', 'ProfileController@edit'); 
    Route::post('profile/update', 'ProfileController@update'); 
    Route::group(['middleware' => ['can:delete user']], function () {
    Route::get('profile/delete', 'ProfileController@destroy');
});
    Route::get('post/list', 'PostController@index');
    Route::get('post/create', 'PostController@create');  
    Route::post('post/insert', 'PostController@insert');  
    Route::get('post/{url}/details', 'PostController@details');

    Route::get('post/search', 'PostController@search');
    Route::get('post/search_all', 'PostController@search_results_all');
    Route::get('post/get_list', 'PostController@get_list');
    Route::get('post/sort', 'PostController@sort');

    Route::get('post/{url}/edit', 'PostController@edit'); 
    Route::post('post/update', 'PostController@update'); 
    Route::get('post/delete', 'PostController@destroy');
});