<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;

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
        $post->post_url = Str::slug($request->input('post_url'));
        if ($this->postRepository->checkURL($post->post_url)->count() > 0) {
            $message = "Đường dẫn đã tồn tại";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../post/add';</script>";

        }

        $post->post_author = Auth::user()->username_login;
        $post->save();

        return redirect('post/list')->with('status', 'Thêm bài viết thành công');
    }

    function list()
    {

        $post = $this->postRepository->listPost();
        if ($post->isEmpty()) {
            return redirect('post/add');
        }

        foreach ($post as $value) {
            $auth_id = $value['userInfo']['role_id'];
        }

        // if ($auth_id == 1) {
        //     $users = Post::with('userInfo')
        //         ->paginate(1);
        //     $list = Profile::paginate(1);
        // }
        // if ($auth_id == 2) {
        //     $users = Post::with('userInfo')->where('user_id', '<>', 1)
        //         ->paginate(1);
        //     $list = Profile::where('id', '<>', 1)->paginate(1);
        // } else {
        // $users = Post::with('userInfo')->where('user_id', $auth_id)
        //     ->paginate(1);
        // $list = Profile::where('id', $auth_id)->paginate(1);
        //}

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
    public function edit($url)
    {
        if ($url != Auth::user()->post_url) {
            $message = "Bạn không có quyền truy cập vào trang này";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../list';</script>";
        }
        $posts = $this->postRepository->find($url);
        return view('post.edit', compact('posts'));
    }

    public function update(PostRequest $request, $id)
    {

        // return $request->all();

        $data['post_title'] = $request->input('post_title');
        $data['post_body'] = $request->input('post_body');
        $data['post_url'] = Str::slug($request->input('post_url'));
        if ($this->postRepository->checkURL($data['post_url'])->count() > 0) {
            $message = "Đường dẫn đã tồn tại";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../list';</script>";

        }
        $data['post_author'] = $request->input('post_author');

        $this->postRepository->updatePost($data, $id);
        return redirect('post/list')->with('status', 'Sửa thành công');
    }
    public function show($url)
    {
        $posts = $this->postRepository->find($url);

        return view('post.show', compact('posts'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $searchTitle = $this->postRepository->searchPost($search);
        $searchTitle->append($request->all());
        return view('post.search', compact('searchTitle'));
    }
}
