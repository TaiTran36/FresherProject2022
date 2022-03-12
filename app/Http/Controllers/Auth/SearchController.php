<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) 
    {
        $search = $request->input('search');
        $posts = Post::where('title', 'LIKE', "%{$search}%")->get();
        $fields = array("title" => "Title", "author" => "Author", "created_at" => "Created_at");
        return view('auth.post.listPost', compact('posts', 'fields'));
    }
}
