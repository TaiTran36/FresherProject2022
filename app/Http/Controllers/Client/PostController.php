<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LikeRepository;
use App\Repositories\CommonRepository;
use Auth;

class PostController extends Controller
{
    protected $likeRepository;
    protected $commonRepository; 

    public function __construct(LikeRepository $likeRepository, CommonRepository $commonRepository)
    {
        $this->likeRepository = $likeRepository;
        $this->commonRepository = $commonRepository; 
    }
    
    public function read($postUrl)
    {
        $post = $this->commonRepository->findPostByUrl($postUrl);
        
        $postId = $post->id;
        $comments = $this->commonRepository->findCommentByPost($postId);

        $liked = null; 
        $disliked = null;

        if (Auth::user()) {
            $data = [
                'user_id' => Auth::user()->id, 
                'likeable_id' => $postId, 
            ];

            $data['likeable_type'] = "like"; 
            $liked = $this->likeRepository->findUserLikedPost($data);

            $data['likeable_type'] = "dislike"; 
            $disliked = $this->likeRepository->findUserDislikedPost($data);
        }
        $likeNum = $this->likeRepository->countLikeOfAPost($postId);
        $dislikeNum = $this->likeRepository->countDislikeOfAPost($postId);

        return view('auth.post.detailPost', compact('post', 'comments', 'liked', 'disliked', 'likeNum', 'dislikeNum')); 
    }
}
