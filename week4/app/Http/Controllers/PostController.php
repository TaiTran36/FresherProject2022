<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    function add()
    {
        return view('post.add');
    }

    public function store(Request $request)
    {
        if ($request->input('btn_add')) {
            // return $request->input();
            $request->validate(
                [
                    'post_title' => 'required|string|max:100',
                    'post_body' => 'required|string|max:3000',
                    'post_url' => 'required|string|max:255',

                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min kí tự',
                    'max' => ':attribute có độ dài ít nhất :max kí tự'
                ],
                [
                    'post_title' => 'Tiêu đề bài viết',
                    'post_body' => 'Nội dung',
                    'post_url' => 'URL',

                ]
            );
            $post = new Post;
            $post->post_title = $request->input('post_title');
            $post->user_id = Auth::user()->id;
            $post->post_body = $request->input('post_body');
            $post->post_url = $request->input('post_url');
            $post->post_author = Auth::user()->username_login;

            $post->save();
        }
        return redirect('post/list')->with('status', 'Thêm bài viết thành công');
    }

    function list()
    {
        $post = Post::with('userInfo')->where('user_id', Auth::id())->get();
        foreach ($post as $value) {
            $auth_id = $value['userInfo']['role_id'];
        }
        // dd();
        if ($auth_id == 1) {
            $users = Post::with('userInfo')
                ->get();
            $list = Profile::get();
        } else
        if ($auth_id == 2) {
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
            'auth_id'=>$auth_id
        ];
        return view('post.list', compact('data'));
    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            $posts = Post::find($id);
            $posts->delete();

            return redirect('post/list')->with('status', 'Đã xóa thành công');
        } else {
            return redirect('post/list')->with('status', 'Không thể xóa chính mình');
        }
    }
    public function edit($id)
    {
        $posts = Post::find($id);
        return view('post.edit', compact('posts'));
    }

    public function update(Request $request, $id)
    {
        if ($request->input('btn_edit')) {
            $request->validate(
                [
                    'post_title' => 'required|string|max:100',
                    'post_body' => 'required|string|max:3000',
                    'post_url' => 'required|string|max:255',
                    'post_author' => 'required|string|max:100',
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min kí tự',
                    'max' => ':attribute có độ dài ít nhất :max kí tự'
                ],
                [
                    'post_title' => 'Tiêu đề bài viết',
                    'post_body' => 'Nội dung',
                    'post_url' => 'URL',
                    'post_author' => 'Tác giả',
                ]
            );
        }
        // return $request->all();
        Post::where('id', $id)->update([
            'post_title' => $request->input('post_title'),
            'post_body' => $request->input('post_body'),
            'post_url' => $request->input('post_url'),
            'post_author' => $request->input('post_author'),
        ]);
        return redirect('post/list')->with('status', 'Sửa thành công');
    }
    public function show($id)
    {
        $posts = Post::find($id);
        return view('post.show', compact('posts'));
    }
}
