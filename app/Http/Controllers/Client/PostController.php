<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LikeRepository;
use App\Repositories\CommonRepository;
use App\Repositories\UserRepository;
use App\Repositories\FollowRepository;
use Auth;

class PostController extends Controller
{
    protected $likeRepository;
    protected $commonRepository; 
    protected $userRepository; 
    protected $followRepository;

    public function __construct(LikeRepository $likeRepository, CommonRepository $commonRepository, UserRepository $userRepository, FollowRepository $followRepository)
    {
        $this->likeRepository = $likeRepository;
        $this->commonRepository = $commonRepository; 
        $this->userRepository = $userRepository;
        $this->followRepository = $followRepository; 
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

    public function showPostOfAnUser($username)
    {
        $user = $this->userRepository->findUserByUsername($username); 
        $posts = $this->commonRepository->findPostByUser($username); 
        
        if(Auth::user()) {
            $data =[
               'followed_id' => $user->id,
               'follower_id' => Auth::user()->id,
            ];

            $followed = $this->followRepository->findUserFollowed($data);
        }

        return view('auth.post.user.listPost', compact('user', 'posts', 'followed'));
    }
}
