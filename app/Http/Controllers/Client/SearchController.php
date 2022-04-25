<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Repositories\UserRepository; 
use App\Repositories\CategoryRepository; 
use App\Repositories\CommonRepository; 
use App\Repositories\PostRepository; 
use App\Repositories\FollowRepository; 

class SearchController extends Controller
{
    protected $userRepository;
    protected $categoryRepository;
    protected $commonRepository;
    protected $postRepository;
    protected $followRepository;

    public function __construct (
                UserRepository $userRepository, 
                CategoryRepository $categoryRepository, 
                CommonRepository $commonRepository, 
                PostRepository $postRepository, 
                FollowRepository $followRepository)
    {
        $this->userRepository = $userRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commonRepository = $commonRepository;
        $this->postRepository = $postRepository;
        $this->followRepository = $followRepository;
    }

    public function searchUser(Request $request, $key)
    {
        if (isset($request['search-text'])) {
            $key = $request['search-text'];
        }

        $users = $this->userRepository->searchUserByUsername($key);

        foreach ($users as $user) {
            $user['numPosts'] = $this->postRepository->countPostsOfAuthor($user['username_login']);
            $user['numFollowers'] = $this->followRepository->countFollower($user['id']);
        }

        return view('auth.post.user.searchUser', compact('users', 'key'));
    }

    public function searchCategory(Request $request, $key)
    {
        $categories = $this->categoryRepository->searchCategory($key);

        return view('auth.post.user.searchCategory', compact('categories', 'key'));
    }

    public function searchPost($key)
    {
        $posts = $this->commonRepository->findPostByKey($key);

        foreach ($posts as $post) {
            $post['numPostsOfAuthor'] = $this->postRepository->countPostsOfAuthor($post['author']);
        }

        return view('auth.post.user.searchPost', compact('posts', 'key'));
    }
}