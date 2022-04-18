<?php

namespace App\Http\Controllers\Client;

use Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Repositories\CommonRepository;

class CommentController extends Controller
{
    protected $commentRepository;
    protected $commonRepository; 

    public function __construct(CommentRepository $commentRepository, CommonRepository $commonRepository)
    {
        $this->middleware('auth');
        $this->commentRepository = $commentRepository;
        $this->commonRepository = $commonRepository; 
    }

    public function store(CommentRequest $request, $postUrl)
    { 
        $dataInsert = [
            'post_id' => $request['post_id'],
            'user_id' => Auth::user()->id,
            'content' => $request['content'], 
        ];

        $this->commentRepository->createComment($dataInsert); 

        return back();
    }

    public function more(Request $request) 
    {
        $postUrl = $request['post_url']; 
        $commentId = $request['comment_id']; 

        $post = $this->commonRepository->findPostByUrl($postUrl);
        
        $postId = $post->id;
        $comments = $this->commonRepository->findCommentByPost($postId);
        
        $comment = $comments[$commentId]; 

        if($request->ajax()) {
            return response()->json([
                'content' => $comment['content'],
            ]);
        }
        return back();
    }
}
