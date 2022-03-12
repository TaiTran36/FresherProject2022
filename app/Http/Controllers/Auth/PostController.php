<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Post; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if (!$this->userCan('view-list-post'))  abort('403', __('Access denied'));
        $posts = Post::latest()->paginate(10); 
        if(request('search')) {
            $search = $request->input('search');
            $posts = Post::where('title', 'LIKE', "%{$search}%")->latest()->get();
        }
        $fields = array("title" => "Title", "author" => "Author", "created_at" => "Created_at", "action" => "Action");
        return view('auth.post.listPost', compact('posts', 'fields'))
            ->with('i', (request()->input('page', 1) - 1) * 10); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.post.addPost'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user(); 
        $request->validate([
            'title' => ['required', 'string', 'max:200'], 
            'url' => ['string', 'max: 60', 'nullable'], 
            'content' => ['required', 'string', 'min: 100', 'max: 1000'], 
        ]); 

        if(Post::where('title', $request->input('title'))->exists()) {
            return back()->with('error', 'Post exists');
        } else {
            $post = $request->all(); 
            $post['author'] = $user->username_login; 
            $newPost = Post::create($post);
            return redirect()->route('home')->with('status', 'Post created successfully!'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $title = $post->title;
        return view('auth.post.editPost', compact('post', 'title')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:200'],  
            'content' => ['required', 'string', 'min: 100', 'max: 1000'], 
        ]);

        $post->update($request->all()); 

        return redirect()->route('post.search')
            ->with('success', 'Post updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function search(Request $request) 
    {
        $search = $request->input('search-input');
        $posts = Post::where('title', 'LIKE', "%{$search}%")->get();
        $fields = array("title" => "Title", "author" => "Author", "created_at" => "Created_at", "action" => "Action");
        return view('auth.post.listPost', compact('posts', 'fields'))
            ->with('i', (request()->input('page', 1) - 1) * 10); ;
        // return view('auth.post.demoSearch', compact('posts'));
    }
}
