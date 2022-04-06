<?php 

namespace App\Repositories;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommonRepository {
    public $user;
    public $post; 
    public $comment;

    public function __construct(User $user, Post $post, Comment $comment) 
    {
        $this->user = $user; 
        $this->post = $post; 
        $this->comment = $comment;
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

    public function findCommentByPost($id)
    {
        return $this->comment
                    ->where('post_id', $id)
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->select('comments.*', 'users.username_login', 'users.photo_url')
                    ->get();
    }
}