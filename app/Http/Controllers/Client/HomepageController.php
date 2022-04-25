<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\PostRepository;
use App\Repositories\CommonRepository;
use Illuminate\Support\Str;


class HomepageController extends Controller
{
    protected $categoryRepository;
    protected $commonRepository; 

    public function __construct(CategoryRepository $categoryRepository, PostRepository $postRepository, CommonRepository $commonRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
        $this->commonRepository = $commonRepository; 
    }

    public function index()
    {
        $posts = $this->commonRepository->concatUserAndPost(); 
        
        $categories = $this->categoryRepository->getAllCategory();

        foreach ($posts as $post) {
            $post['numPostsOfAuthor'] = $this->postRepository->countPostsOfAuthor($post['author']);
        }

        return view('auth.post.viewPosts', compact('posts', 'categories'));
    }

    public function showByCategory($category)
    {
        $categories = $this->categoryRepository->getAllCategory();
        $categories = array_map('strtolower', $categories);

        $posts = $this->commonRepository->findPostByCategory(ucfirst($category));

        foreach ($posts as $post) {
            $post['numPostsOfAuthor'] = $this->postRepository->countPostsOfAuthor($post['author']);
        }

        return view('auth.post.showByCategory', compact('posts', 'category')); 
    }
}
