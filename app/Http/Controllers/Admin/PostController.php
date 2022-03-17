<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Models\Post; 
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use App\Repositories\PostRepository;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        if (!$this->userCan('view-list-post'))  abort('403', __('Access denied'));
        
        $data = [];
        if(isset($request['search-post'])) { 
            $data['search'] = $request->input('search-post');
        }

        $posts = $this->postRepository->getListPost($data);

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
    public function store(PostRequest $request)
    {
        $user = Auth::user(); 

        if(!empty($this->postRepository->findPost('title', $request['title']))) {
            return back()->with('error', 'Post exists');
        } else {
            $dataInsert = [
                'title' => $request['title'], 
                'author' => $user->username_login, 
                'url' => $request['url'],
                'content' => $request['content'],
            ];
            $this->postRepository->createPost($dataInsert); 
            
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
    public function edit($postId)
    {
        $post = $this->postRepository->findPost('id', $postId);

        return view('auth.post.editPost', compact('post')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request)
    {
        $dataUpdate = [
            'id' => $request['id'],
            'title' => $request['title'],
            'url' => $request['url'],
            'content' => $request['content'],
        ];

        $this->postRepository->updatePost($dataUpdate);

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
