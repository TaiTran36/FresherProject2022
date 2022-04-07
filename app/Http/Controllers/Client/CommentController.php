<?php

namespace App\Http\Controllers\Client;

use Auth;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->middleware('auth');
        $this->commentRepository = $commentRepository;
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
}
