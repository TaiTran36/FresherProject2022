<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\CategoryRepositories;
use App\Repositories\PostRepositories;
use Illuminate\Http\Request;

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
        $categories=$this->categoryRepository->getAll();
        $posts=$this->categoryRepository->getAllPostFromCat();
        $cats=$this->categoryRepository->getAllCatFromPost();
        return view('welcome')->with('categories',$categories)->with('posts',$posts)->with('cats',$cats);
    }
}
