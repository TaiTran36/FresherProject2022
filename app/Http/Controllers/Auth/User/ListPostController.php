<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ListPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPosts() 
    {
        if (!$this->userCan('view-list-post'))  abort('403', __('Access denied'));
        $fields = array("title" => "Title", "author" => "Author", "created_at" => "Created_at"); 
        $data = Post::orderByDesc('created_at')->get();
        return view('auth.admin.listPost', compact('fields', 'data'));
    }

    public function getDetailPost($title) 
    {
        $post = Post::where('title', $title)->get(); 
        return view('auth.admin.editPost', compact($post)); 
    }
}
