<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepositories;
use App\Repositories\PostRepositories;
use App\Repositories\UserRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositories $postRepository, CategoryRepositories $categoryRepository,UserRepositories $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories=$this->categoryRepository->getAll();
        $new_posts=$this->postRepository->client_get5NewPost();
        $posts=$this->postRepository->client_getAllPost();
        $cats=$this->categoryRepository->getAllCatFromPost();
        $active_cats=$this->categoryRepository->getActiveCats();
        return view('welcome')->with('categories',$categories)->with('active_cats',$active_cats)->with('posts',$posts)->with('new_posts',$new_posts)->with('cats',$cats);
    }
    public function post_by_cate($name)
    {
        $categories=$this->categoryRepository->getAll();
        $posts=$this->categoryRepository->getAllPostFromCat($name);
        $cats=$this->categoryRepository->getAllCatFromPost();
        return view('client.client_post_by_cate')->with('categories',$categories)->with('category_name',$name)->with('posts',$posts)->with('cats',$cats);
    }
    public function client_search(Request $request)
    {
            $key=$request->client_search;
            $categories=$this->categoryRepository->getAll();
            $cats=$this->categoryRepository->getAllCatFromPost();
            $listpost = $this->postRepository->client_search($key);
            return view('client.post_search')->with('categories',$categories)->with('listpost',$listpost)->with('key',$key)->with('cats',$cats);
    }
    public function client_search_page(Request $request)
    {
        if($request->ajax()){
        $cats=$this->categoryRepository->getAllCatFromPost();
        $listpost = $this->postRepository->client_search($request->key);
        return view('client.data_posts_search')->with('listpost',$listpost)->with('cats',$cats);
        // return "ok";
    }
}
    public function post_by_cate_page(Request $request)
    {
        if($request->ajax()){
        $categories=$this->categoryRepository->getAll();
        $posts=$this->categoryRepository->getAllPostFromCat($request->category);
        $cats=$this->categoryRepository->getAllCatFromPost();
        return view('client.data_posts_by_cate')->with('categories',$categories)->with('category_name',$request->category)->with('posts',$posts)->with('cats',$cats);
        }
    }
    public function post_by_author($username_login)
    {
        $writer=$this->postRepository->getAuthor($username_login);
        $categories=$this->categoryRepository->getAll();
        $posts=$this->postRepository->getAllPostByAuthor($username_login);
        $followers=$this->userRepository->getFollowerByUsername($username_login);
        $cats=$this->categoryRepository->getAllCatFromPost();
        if(Auth::user()){ $user_id=Auth::user()->id;} else $user_id=0;
        $followed=$this->userRepository->checkFollowed($username_login,$user_id);
        return view('client.client_post_by_author')->with('followed',$followed)->with('followers',$followers)->with('categories',$categories)->with('writer',$writer)->with('posts',$posts)->with('cats',$cats);
    }
    public function post_by_author_page(Request $request)
    {
        if($request->ajax()){
        $writer=$this->postRepository->getAuthor($request->username_login);
        $categories=$this->categoryRepository->getAll();
        $posts=$this->postRepository->getAllPostByAuthor($request->username_login);
        $cats=$this->categoryRepository->getAllCatFromPost();
        return view('client.data_posts_by_author')->with('categories',$categories)->with('writer',$writer)->with('posts',$posts)->with('cats',$cats);
        }
    }
    public function client_details($url)
    {   
        $getData = $this->postRepository->details($url);
        $categories=$this->categoryRepository->getAll();
        $list_comments= $this->postRepository->comments($url);
        $id= $this->postRepository->getId($url);
        $likes = $this->postRepository->likes($id);
        $dislikes = $this->postRepository->dislikes($id);
        $liked=0;
        if(Auth::check()){
            $liked_user= $this->postRepository->liked($id,Auth::user()->id);
            $disliked_user= $this->postRepository->disliked($id, Auth::user()->id);
            if($disliked_user==1){$liked=-1;};
            if($liked_user==1){$liked=1;};
        };
        return view('client.client_details')->with('post',$getData)->with('categories',$categories)->with('list_comments',$list_comments)->with('count_like',$likes)->with('count_dislike',$dislikes)->with('liked',$liked);
    }
    public function client_details_comments($url) //pagination comments
    {   
        $list_comments= $this->postRepository->comments($url);
        $count=$list_comments->total(); 
        $comments_views= view('client.comment_list', compact('list_comments'))->render();
        return response()->json(['comments_views' => $comments_views, 'count' => $count]);
    }
    function save_comment(Request $request){
        if ($request->ajax()) {
            $this->postRepository->add_comment($request);
            $list_comments= $this->postRepository->comments($request->post_url);
            $count=$list_comments->total(); 
            $comments_views= view('client.comment_list', compact('list_comments'))->render();
            return response()->json(['comments_views' => $comments_views, 'count' => $count]);
            // return redirect('/post/'.$request->url.'/client_details')->with('post',$getData)->with('categories',$categories)->with('list_comments',$list_comments);
    }}
    function edit_comment(Request $request){
        if ($request->ajax()) {
            $this->postRepository->update_comment($request);
            $comment= $this->postRepository->getComment($request->comment_id);
            return response($comment);
    }}
    function delete_comment(Request $request){
        if ($request->ajax()) {
            $this->postRepository->delete_comment($request->comment_id);
            $list_comments= $this->postRepository->comments($request->post_url);
            $count=$list_comments->total(); 
            $comments= view('client.comment_list', compact('list_comments'))->render();
            return response()->json(['comments_views' => $comments, 'count' => $count]);
    }}
    public function like(Request $request)
    {
        if ($request->ajax()) {
            $this->postRepository->destroy_like_dislike($request->post_id);
            $this->postRepository->addLike($request->post_id);
        }
        $likes = $this->postRepository->likes($request->post_id);
        $dislikes = $this->postRepository->dislikes($request->post_id);
        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }
    public function unlike(Request $request)
    {
        if ($request->ajax()) {
            $this->postRepository->destroy_like_dislike($request->post_id);
        }
        $likes = $this->postRepository->likes($request->post_id);
        return response()->json(['likes' => $likes]);
    }
    public function undislike(Request $request)
    {
        if ($request->ajax()) {
            $this->postRepository->destroy_like_dislike($request->post_id);
        }
        $dislikes = $this->postRepository->dislikes($request->post_id);
        return response()->json(['dislikes' => $dislikes]);
    }
    public function dislike(Request $request)
    {
        if ($request->ajax()) {
            $this->postRepository->destroy_like_dislike($request->post_id);
            $this->postRepository->addDislike($request->post_id);
        }
        $likes = $this->postRepository->likes($request->post_id);
        $dislikes = $this->postRepository->dislikes($request->post_id);
        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }
    public function count_like_dislike(Request $request)
    {
        $likes = $this->postRepository->likes($request->post_id);
        $dislikes = $this->postRepository->dislikes($request->post_id);
        return response()->json(['likes' => $likes, 'dislikes' => $dislikes]);
    }
}
