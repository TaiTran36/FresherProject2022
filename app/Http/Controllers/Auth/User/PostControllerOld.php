<?php

namespace App\Http\Controllers\Auth\User;

use Auth; 
use Session;
use App\Models\User;
use App\Models\Post; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function show() 
    {
        return view('auth.user.post');
    }

    public function insert(Request $request) 
    {
        $user = Auth::user(); 
        $request->validate([
            'title' => ['required', 'string', 'max:200'], 
            'url' => ['string', 'max: 60', 'nullable'], 
            'content' => ['required', 'string', 'min: 100', 'max: 1000'], 
        ]); 

        // $post = new Post; 
        // $post->title = $request->input('title'); 
        // $post->author = $user->username_login; 
        // $post->url = $request->input('url'); 
        // $post->content = $request->input('content');
        // $post->save();

        if(Post::where('title', $request->input('title'))->exists()) {
            return back()->with('error', 'Post exists');
        } else {
            $post = $request->all(); 
            $post['author'] = $user->username_login; 
            $newPost = Post::create($post);
            return redirect()->route('home')->with('status', 'Post created successfully!'); 
        }
    }
    public function update(Request $request, Post $post) 
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'], 
            'content' => ['required', 'string', 'min: 100', 'max: 1000'], 
        ]); 

        $post->title = $request->title; 
        $post->content = $request->content; 
        $post->save(); 

        return back()->with('success', 'Post updated successfully'); 
    }
}
