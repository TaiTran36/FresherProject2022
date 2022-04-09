<?php

namespace App\Http\Controllers;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
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
        $post= $this->postRepository->all();
        $categories=$this->categoryRepository->getAll();
        return view('welcome')->with('post',$post)->with('categories',$categories);
    }
}


