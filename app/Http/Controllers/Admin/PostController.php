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
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->userCan('create-post'))  abort('403', __('Access denied'));

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
        $title = $request['title']; 
        if(empty($title)) 
        {
            $title = Str::limit($request['content'], $limit = 70, $end = '...'); 
        }
        
        $dataInsert = [
            'title' => $title, 
            'author' => $user->username_login, 
            'url' => $request['url'],
            'content' => $request['content'],
        ];

        if ($this->postRepository->findPostByUrl($dataInsert['url']) == FALSE) 
        {
            return back()->with('error', 'Url exists')->withInput($request->all());
        }  
        
        $this->postRepository->createPost($dataInsert); 

        return redirect()->intended('home')->with('status', 'Post created successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {
        if (is_numeric($postId)) 
        {
            $post = $this->postRepository->findPost($postId);
        } else {
            $post = $this->postRepository->findPostByUrl($postId);
        }

        return view('auth.post.showPost', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($postId)
    {
        if (!$this->userCan('edit-another-post'))  abort('403', __('Access denied'));

        if (is_numeric($postId)) 
        {
            $post = $this->postRepository->findPost($postId);
        } else {
            $post = $this->postRepository->findPostByUrl($postId);
        }

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
        $url = Str::replace(' ', '-', $request['url']);

        $dataUpdate = [
            'id' => $request['id'],
            'title' => $request['title'],
            'url' => $url,
            'content' => $request['content'],
        ];  

        if ($this->postRepository->checkExistUrl($dataUpdate) == FALSE) 
        {
            return back()->with('error', 'Url exists')->withInput($request->all());
        } 
            
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
    public function destroy($postId)
    {
        if (!$this->userCan('delete-another-post'))  abort('403', __('Access denied'));

        $this->postRepository->deletePost($postId); 

        return redirect()->route('post.search')->with('success', 'Post deleted successfully!'); 
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
