<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\CategoryRepositories;
use App\Repositories\PostRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepositories $postRepository, CategoryRepositories $categoryRepository)
    {
        $this->postRepository = $postRepository;
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
    public function post_by_author($username_login)
    {
        $writer=$this->postRepository->getAuthor($username_login);
        $categories=$this->categoryRepository->getAll();
        $posts=$this->postRepository->getAllPostByAuthor($username_login);
        $cats=$this->categoryRepository->getAllCatFromPost();
        return view('client.client_post_by_author')->with('categories',$categories)->with('writer',$writer)->with('posts',$posts)->with('cats',$cats);
    }
    public function client_details($url)
    {   
        $getData = $this->postRepository->details($url);
        $categories=$this->categoryRepository->getAll();
        // $categories[] =  $this->categoryRepository->get_where_post($url);
        $list_comments= $this->postRepository->comments($url);
        $id= $this->postRepository->getId($url);
        $likes = $this->postRepository->likes($id);
        $liked_user= $this->postRepository->liked($id);
        $dislikes = $this->postRepository->dislikes($id);
        $disliked_user= $this->postRepository->disliked($id);
        $liked=0;
        if(Auth::check()){
            if(Auth::user()->id==$disliked_user){$liked=-1;};
            if(Auth::user()->id==$liked_user){$liked=1;};
        };
        return view('client.client_details')->with('post',$getData)->with('categories',$categories)->with('list_comments',$list_comments)->with('count_like',$likes)->with('count_dislike',$dislikes)->with('liked',$liked);
    }
    public function client_details_comments($url) //pagination comments
    {   
        $list_comments= $this->postRepository->comments($url);
        return view('client.comment_list')->with('list_comments',$list_comments);
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
}
