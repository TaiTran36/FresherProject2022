<?php

namespace App\Http\Controllers;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
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
        $post= $this->postRepository->all();
        $categories=$this->categoryRepository->getAll();
        $posts=$this->categoryRepository->get_post_index();
        $cate=$this->categoryRepository->get_cate_index();
        return view('welcome')->with('posts',$posts)->with('post',$post)->with('categories',$categories)->with('cate',$cate);
    }
    public function post_by_cate($name)
    {
        $categories=$this->categoryRepository->getAll();
        $posts=$this->categoryRepository->getPostFromCat($name);
        $cats=$this->categoryRepository->get_cate_index();
        return view('all_post.post_cate')->with('categories',$categories)->with('category_name',$name)->with('posts',$posts)->with('cats',$cats);
    }
    public function post_by_user($id, $username)
    {
        $writer=$this->postRepository->getAuthor($id,$username);
        $categories=$this->categoryRepository->getAll();
        $posts=$this->postRepository->getAllPostByAuthor($id,$username);
        $cats=$this->categoryRepository->get_cate_index();
            if(Auth::user())
            {
                $id2=Auth::user()->id;
            } 
            else $id2=0;      
        $follow=$this->postRepository->hassubscribe($id,$id2);
        $countfollow=$this->postRepository->countfollow($id);
        $tb=$this->postRepository->tb($id,$id2);
        return view('all_post.post_user')->with('tb',$tb)->with('categories',$categories)->with('writer',$writer)->with('posts',$posts)->with('cats',$cats)->with('follow',$follow)->with('countfollow',$countfollow);
    }
}


