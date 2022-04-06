<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CommonRepository;

class PostController extends Controller
{
    protected $commonRepository; 

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository; 
    }
    
    public function read($postUrl)
    {
        $post = $this->commonRepository->findPostByUrl($postUrl);
        $postId = $post->id;
        $comments = $this->commonRepository->findCommentByPost($postId);

        return view('auth.post.readPost', compact('post', 'comments')); 
    }
}
