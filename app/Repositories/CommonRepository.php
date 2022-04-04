<?php 

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;

class CommonRepository {
    public $user;
    public $post; 

    public function __construct(User $user, Post $post) 
    {
        $this->user = $user; 
        $this->post = $post; 
    }

    public function concatUserAndPost()
    {
        return $this->post
                    ->join('users', 'posts.author', '=', 'users.username_login')
                    ->select('posts.*', 'users.photo_url')
                    ->latest()
                    ->paginate(9); 
    }

    public function findPostByUrl($url)
    {
        return $this->post
                    ->where('url', $url)
                    ->join('users', 'posts.author', '=', 'users.username_login')
                    ->select('posts.*', 'users.photo_url')
                    ->first(); 
    }

    public function findPostByCategory($category)
    {
        return $this->post
                    ->where('category', $category)
                    ->join('users', 'posts.author', '=', 'users.username_login')
                    ->select('posts.*', 'users.photo_url')
                    ->latest()
                    ->paginate(9); 
    }
}