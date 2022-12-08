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

Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('welcome');

Route::get('post_event', 'EventController@postEvent');
Route::get('category_event', 'EventController@categoryEvent');
Route::get('profile_event', 'EventController@profileEvent');
Route::get('comment_event', 'EventController@commentEvent');
Route::get('like_event', 'EventController@likeEvent');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('auth/social', 'Auth\LoginController@show')->name('social.login');
Route::get('oauth/{driver}', 'Auth\LoginController@redirectToProvider')->name('social.oauth');
Route::get('oauth/{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');

Route::get('post/{url}/client_details', 'ClientController@client_details');
Route::post('post/client_search', 'ClientController@client_search');
Route::get('post/client_search_page', 'ClientController@client_search_page');
Route::get('post/{url}/client_details_comments', 'ClientController@client_details_comments'); //pagination comments
Route::get('post/{url}/count_like_dislike', 'ClientController@count_like_dislike');
Route::get('category/{name}/posts', 'ClientController@post_by_cate');
Route::get('category/{category}/posts_page', 'ClientController@post_by_cate_page');
Route::get('author/{username_login}/posts', 'ClientController@post_by_author');
Route::get('author/{username_login}/posts_page', 'ClientController@post_by_author_page');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('users-export', 'export')->name('users.export');
        Route::post('users-import', 'import')->name('users.import');
    });
    Route::controller(PostController::class)->group(function () {
        Route::get('posts-export', 'export')->name('posts.export');
        Route::post('posts-import', 'import')->name('posts.import');
    });
    Route::get('post/save-comment', 'ClientController@save_comment');
    Route::get('post/edit-comment', 'ClientController@edit_comment');
    Route::get('post/delete-comment', 'ClientController@delete_comment');
    Route::get('post/like', 'ClientController@like');
    Route::get('post/unlike', 'ClientController@unlike');
    Route::get('post/dislike', 'ClientController@dislike');
    Route::get('post/undislike', 'ClientController@undislike');
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
    Route::get('profile/count', 'ProfileController@count');
    Route::get('profile/follow', 'ProfileController@follow');
    Route::get('profile/unfollow', 'ProfileController@unfollow');
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
    /////test ////
    Route::get('post/expands', 'PostController@get_expands');
    ///////////

    Route::get('post/count', 'PostController@count');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('category/delete', 'CategoryController@destroy');
        Route::get('category/insert', 'CategoryController@insert');
        Route::get('category/edit', 'CategoryController@edit');
    });
    Route::group(['middleware' => ['role:admin|modder']], function () {
        Route::get('category/list', 'CategoryController@index');
        Route::get('category/get_list', 'CategoryController@get_list');
        Route::get('category/search', 'CategoryController@search');
        Route::get('category/search_all', 'CategoryController@search_results_all');
        Route::get('category/count', 'CategoryController@count');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
