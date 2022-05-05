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
use App\Http\Controllers\Client\SendMailController;
use App\Repositories\UserRepository;
use App\Repositories\FollowRepository;
use App\Repositories\CategoryRepository;
use Mail;
use App\Mail\SendNewPost;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $postRepository;
    protected $sendMail;
    protected $userRepository;
    protected $followRepository;
    protected $categoryRepository;
    public function __construct(PostRepository $postRepository, SendMailController $sendMail, UserRepository $userRepository, FollowRepository $followRepository, CategoryRepository $categoryRepository)
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->sendMail = $sendMail;
        $this->userRepository = $userRepository;
        $this->followRepository = $followRepository;
        $this->categoryRepository = $categoryRepository;
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

        $categories = $this->categoryRepository->getAllCategory();

        return view('auth.post.addPost', compact('categories')); 
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
        if(empty($title)) {
            $title = Str::limit($request['content'], $limit = 50, $end = '...'); 
        }

        $url = $request['url']; 
        if(empty($url)) {
            $url = Str::replace(' ', '-', $title);
        }

        $dataInsert = [
            'title' => $title, 
            'author' => $user->username_login, 
            'url' => $url,
            'category' => $request->category,
            'content' => $request['content'],
        ];

        if($request->hasFile('image')) { 
            $image = $request->image; 
            $image_name = $image->hashName(); 
            $image->move(public_path('/images'), $image_name); 
            $dataInsert['image'] = $image_name; 
        }

        if (!empty($this->postRepository->findPostByUrl($dataInsert['url']))) 
        {
            return back()->with('error', 'Url exists')->withInput($request->all());
        }  
        
        $this->postRepository->createPost($dataInsert);    
        
        //Send mail
        $user = $this->userRepository->findUserByUsername($dataInsert['author']);
        $followed_id = $user['id'];
        $receivers = $this->followRepository->findFollowerList($followed_id);

        foreach ($receivers as $r) {
            $follower_id = $r['follower_id'];
            $follower = $this->userRepository->findUser($follower_id);

            Mail::send('auth.follow.contentMail', 
                ['data' => $dataInsert, 'follower' => $follower['username_login']], 
                function($message) use($follower, $dataInsert) {
                $message->to($follower['email']);
                $message->subject($dataInsert['author']. ' posted a new post in ' .config('app.name'));
            });

            // dispatch($sendMail);
        }

        return redirect()->intended('home')->with('status', 'Post created successfully!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($postUrl)
    {
        $post = $this->postRepository->findPostByUrl($postUrl);

        return view('auth.post.showPost', compact('post')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($postUrl)
    {
        if (!$this->userCan('edit-another-post'))  abort('403', __('Access denied'));

        $post = $this->postRepository->findPostByUrl($postUrl);
        $ctgs = $post->category;
        $categories = $this->categoryRepository->getAllCategory();

        return view('auth.post.editPost', compact('post', 'categories', 'ctgs')); 
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
        $title = $request['title']; 
        if(empty($title)) {
            $title = Str::limit($request['content'], $limit = 50, $end = '...'); 
        }

        $url = $request['url']; 
        if(empty($url)) {
            $url = Str::replace(' ', '-', $title);
        }

        $dataUpdate = [
            'id' => $request['id'],
            'title' => $title,
            'url' => $url,
            'category' => $request->category,
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
