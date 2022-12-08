<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Imports\PostsImport;
use App\Jobs\NewPostMail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Pusher\Pusher;

class PostController extends Controller
{
    public function __construct(PostRepositories $postRepository, CategoryRepositories $categoryRepository, UserRepositories $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }
    // test
    public function get_expands(Request $request)
    {
        if ($request->url) {
            $url = $request->url;
        }
        $expands = $this->postRepository->get_expands();
        $data = view('post.expand', compact('expands'))->render();
        return $data;
    }

    ///
    public function export()
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new PostsImport, request()->file('file'));
        return $this->index();
    }
    public function index()
    {
        $listpost = $this->postRepository->getAll(5);
        $data = view('post.list', compact('listpost'))->render();
        return $data;
    }
    function get_list(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $listpost = $this->postRepository->getAll($number);
            return view('post.data', compact('listpost'))->render();
        }
    }
    function count(Request $request)
    {
        if ($request->ajax()) {
            $listpost = $this->postRepository->getAll(5);
            return response($listpost->total());
        }
    }
    public function details($url)
    {
        $getData = $this->postRepository->details($url);
        $categories[] =  $this->categoryRepository->get_where_post($url);
        return view('post.detail')->with('post', $getData)->with('categories', $categories);
    }
    public function create()
    {
        $categories =  $this->categoryRepository->getAll();
        return view('post.create')->with('categories', $categories);
    }
    public function insert(Request $request)
    {
        if ($request->file('image') != null) {
            $image = $request->file('image');
            $imageSaveAsName = time() . rand(99, 99999) . "-" . $image->getClientOriginalName();
            $upload_path = '../public/post/';
            $image_url = $imageSaveAsName;
            $image->move($upload_path, $imageSaveAsName);
            $request->image = $image_url;
        }
        $id = $this->postRepository->insert($request);
        foreach ($request->categories as $value) {
            $this->categoryRepository->insert_post_cat($id, $value);
        }
        $followers = $this->userRepository->followers(Auth::user()->id);
        $post = $this->postRepository->getPostByID($id);
        foreach ($post as $post) {
            foreach ($followers as $follower) {
                $data['user'] =  $follower->id;
                $data['url'] = $post->url;
                $data['writer_name'] = Auth::user()->name;
                $data['writer_avatar'] = Auth::user()->avatar;
                $data['title'] =  $post->title;
                $details = [
                    'writer_name' => Auth::user()->name,
                    'follower_name' => $follower->name,
                    'post_url' => $post->url,
                    'post_title' => $post->title,
                ];
                $job = new NewPostMail($follower->email, $details);
                dispatch($job);
                // Mail::to($follower->email)->send(new \App\Mail\NewPostMail($details));
                $options = array(
                    'cluster' => 'ap1',
                    'encrypted' => true
                );

                $pusher = new Pusher(
                    env('PUSHER_APP_KEY'),
                    env('PUSHER_APP_SECRET'),
                    env('PUSHER_APP_ID'),
                    $options
                );

                $pusher->trigger('Notify', 'new_notify_' . $data['user'], $data);
            }
        }
        return redirect('post/list');
    }
    public function edit($url)
    {
        $categories =  $this->categoryRepository->getAll();
        $post_categories[] =  $this->categoryRepository->get_where_post($url);
        $getData = $this->postRepository->getPost($url);
        $writer_id = $this->postRepository->getPost_writer_id($url);
        $user = new User;
        if ($user->mySelf()->can('edit post') or ($writer_id == Auth::user()->id))
            return view('post.edit')->with('getpostById', $getData)->with('categories', $categories)->with('post_categories', $post_categories);
        else echo "You don't have permission !";
    }
    public function update(Request $request)
    {
        $get_old = $this->postRepository->getPostById($request->id);

        if ($request->file('image') != null) {
            if (File::exists(public_path('/post/' . $get_old[0]->photo_path))) {
                File::delete(public_path('/post/' . $get_old[0]->photo_path));
            }
            $image = $request->file('image');
            $imageSaveAsName = time() . rand(99, 99999) . "-" . $image->getClientOriginalName();
            $upload_path = '../public/post/';
            $image_url = $imageSaveAsName;
            $image->move($upload_path, $imageSaveAsName);
            $request->image = $image_url;
        }
        if ($request->file('image') == null) {
            $request->image = $request->image_old;
        }
        $this->postRepository->update($request);
        $this->categoryRepository->update_post_cat($request->id, $request->categories);
        return redirect('post/list');
    }
    public function destroy(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $this->postRepository->delete($request->url);
            $listpost = $this->postRepository->getAll($number);
            $data = view('post.data', compact('listpost'))->render();
            return response($data);
        }
    }
    public function search(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $listpost = $this->postRepository->search($request->search, $number);
            return view('post.data', compact('listpost'))->render();
        }
    }
    public function search_results_all(Request $request)
    {
        $number = 5;
        if ($request->number) {
            $number = $request->number;
        }
        if ($request->ajax()) {
            $output2 = '';
            $posts = $this->postRepository->search($request->search, $number);
            if ($posts) {
                $output2 .= $posts->total();
            }
            return Response($output2);
        }
    }

    // public function sort(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data =  Post::orderBy('title','desc')->get();
    //         // $data= $this->postRepository->getAll(3);
    //         // return Response($data);
    //         echo $data;
    //                     // return response()->json($data);
    //         // return view('post.data', compact('data'))->render();
    //     }
    // }
}
