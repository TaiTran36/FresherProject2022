<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\LikeRepository;
use Auth;

class LikeController extends Controller
{
    protected $commentRepository;

    public function __construct(LikeRepository $likeRepository)
    {
        $this->middleware('auth');
        $this->likeRepository = $likeRepository;
    } 

    public function like(Request $request)
    {
        $postData = [
            'user_id' => Auth::user()->id,
            'likeable_id' => $request['post_id'], 
            'likeable_type' => $request['type'],
        ]; 
		
        $liked = $this->likeRepository->findUserLikedPost($postData);
        $disliked = $this->likeRepository->findUserDislikedPost($postData);
		
        if ($liked == null && $disliked == null) {
            $this->likeRepository->insertLike($postData);
        } 

        elseif (!empty($liked) && $postData['likeable_type'] == "like") {
            $this->likeRepository->deleteUserLikedPost($postData);
        }

        elseif (!empty($disliked) && $postData['likeable_type'] == "dislike") {
            $this->likeRepository->deleteUserDislikedPost($postData);
        }

        elseif (!empty($liked) && $postData['likeable_type'] == "dislike") {
            $this->likeRepository->deleteUserLikedPost($postData);
            $this->likeRepository->insertLike($postData);
        }
         
        elseif (!empty($disliked) && $postData['likeable_type'] == "like") {
            $this->likeRepository->deleteUserDislikedPost($postData);
            $this->likeRepository->insertLike($postData);
        } 

        $likeNum = $this->likeRepository->countLikeOfAPost($request['post_id']);
        $dislikeNum = $this->likeRepository->countDislikeOfAPost($request['post_id']);

        if ($request->ajax()) {
            return response()->json([
                'likeNum' => $likeNum, 
                'dislikeNum' => $dislikeNum
            ]);
        }

        return back();
    }
}
