<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repositories\PostRepository;
use App\Http\Requests\PostRequest;
use App\Models\Categories;
use App\Repositories\PostCategoryRepository;
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
    public function add()
    {
        $categories = Categories::all();
        return view('post.add', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        return $request->all();
        $post = new Post();
        $post->post_title = $request->input('post_title');
        $post->user_id = Auth::user()->id;
        $post->post_body = $request->input('post_body');
        $post->post_url = Str::slug($request->input('post_url'));
        if ($post->post_url == "") {
            $post->post_url = Str::slug($post->post_title);
        }

        if ($this->postRepository->checkURL($post->post_url)->count() > 0) {
            $message = "Đường dẫn đã tồn tại";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../post/add';</script>";
        }
        if ($request->hasFile('post_thumbnail')) {

            $file = $request->file('post_thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/posts/', $filename);
            $post->post_thumbnail = $filename;
        }
        $post->post_author = Auth::user()->username_login;
        $post->save();
        $post->categories()->sync($request->category_id);
        // return $request->all();

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
        $categories = Categories::all();
        $user_id = Auth::user()->id;

        if ($user_id != $this->postRepository->checkAuthor($url)) {

            $message = "Bạn không có quyền truy cập vào trang này";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../list';</script>";
        }

        $posts = $this->postRepository->findURL($url);
        // return $posts;
        return view('post.edit', compact('posts', 'categories'));
    }

    public function update(PostRequest $request, $id)
    {
        // return $request->all();
        $post = $this->postRepository->findId($id);
        $post->post_title = $request->input('post_title');
        $post->post_body = $request->input('post_body');
        $post_url_old = $request->post_url_old;
        $post->post_url = Str::slug($request->input('post_url'));
        if ($post->post_url == "") {
            $post->post_url = Str::slug($post->post_title);
        }
        
        if ($this->postRepository->findURL($post->post_url)->exists() && $post->post_url != $post_url_old) {
            $message = "Đường dẫn đã tồn tại";
            echo "<script type='text/javascript'>alert('$message'); window.location.href='../list';</script>";
        }

        $post->post_author = $request->input('post_author');
        if ($request->hasFile('post_thumbnail')) {
            $post->post_thumbnail = $request->file('post_thumbnail');
            $old_image = $this->postRepository->findId($id);
            // return dd($old_image);
            $des = 'uploads/posts/' . $old_image->post_thumbnail;
            if (File::exists($des)) {
                File::delete($des);
            }
            $file = $request->file('post_thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/posts/', $filename);
            $post->post_thumbnail = $filename;
        }
        // dd($post->categories()->sync($request->category_id));
        $post->categories()->sync($request->category_id);
        
        $post->save();
        
        return redirect('post/list')->with('status', 'Sửa thành công');
    }
    public function show($url)
    {
        $posts = $this->postRepository->findURL($url);
        $categories = Categories::all();

        return view('post.show', compact('posts', 'categories'));
    }

    public function search(Request $request)
    {

        $search = $request->input('search');
        $searchTitle = $this->postRepository->searchPost($search);

        $searchTitle->append($request->all());
        $post = $this->postRepository->listPost();
        foreach ($post as $value) {
            $auth_id = $value['userInfo']['role_id'];
        }
        $data = [
            'posts' => $post,
            'auth_id' => $auth_id,

        ];
        return view('post.search', compact('searchTitle', 'data'));
    }

    public function index() {
        return view('frontend.details');
    }
}
