<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;

use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    public $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    //add Post
    function add()
    {
        return view('post.add');
    }

    public function store(PostRequest $request)
    {

        $post = new Post;
        $post->post_title = $request->input('post_title');
        $post->user_id = Auth::user()->id;
        $post->post_body = $request->input('post_body');
        $post->post_url = $request->input('post_url');
        $post->post_author = Auth::user()->username_login;
        $post->save();

        return redirect('post/list')->with('status', 'Thêm bài viết thành công');
    }

    function list()
    {

        $post = Post::with('userInfo')->where('user_id', Auth::id())->get();
        if ($post->isEmpty()) {
            return redirect('post/add');
        }

        foreach ($post as $value) {
            $auth_id = $value['userInfo']['role_id'];
        }

        if ($auth_id == 1) {

            $users = Post::with('userInfo')
                ->get();
            $list = Profile::get();
        } else if ($auth_id == 2) {
            $users = Post::with('userInfo')->where('user_id', '<>', 1)
                ->get();
            $list = Profile::where('id', '<>', 1)->get();
        } else {
            $users = Post::with('userInfo')->where('user_id', $auth_id)
                ->get();
            $list = Profile::where('id', $auth_id)->get();
        }

        $data = [
            'posts' => $post,
            'auth_id' => $auth_id,

        ];

        return view('post.list', compact('data'));
    }

    function delete($id)
    {

        $this->postRepository->deletePost($id);

        return redirect('post/list')->with('status', 'Đã xóa thành công');
    }
    public function edit($id)
    {
        $posts = $this->postRepository->find($id);
        return view('post.edit', compact('posts'));
    }

    public function update(PostRequest $request, $id)
    {

        // return $request->all();

        $data['post_title'] = $request->input('post_title');
        $data['post_body'] = $request->input('post_body');
        $data['post_url'] = $request->input('post_url');
        $data['post_author'] = $request->input('post_author');
        
        $this->postRepository->updatePost($data, $id);
        
        return redirect('post/list')->with('status', 'Sửa thành công');
    }
    public function show($id)
    {
        $posts = Post::find($id);
        return view('post.show', compact('posts'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $searchTitle = $this->postRepository->searchPost($search);
        return view('post.search', compact('searchTitle'));
    }
}
