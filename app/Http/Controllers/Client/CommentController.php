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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($postUrl)
    {
        $post = $this->commonRepository->findPostByUrl($postUrl);
        
        $postId = $post->id;

        $comments = $this->commonRepository->findCommentByPost($postId);

        return view('auth.comment.detailPost', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $dataInsert = [
            'post_id' => $request['post_id'],
            'user_id' => Auth::user()->id,
            'content' => $request['content'], 
        ];

        $new_comment = $this->commentRepository->createComment($dataInsert); 

        $comment = $this->commentRepository->findComment($new_comment['id']); 
        $comment['username_login'] = Auth::user()->username_login;
        $comment['photo_url'] = Auth::user()->photo_url;

        if ($request->ajax()) {
            return response()->json([
                'comment' => $comment,
            ]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $comment = $this->commentRepository->findComment($request['comment_id']); 

        if ($request->ajax()) {
            return response()->json([
                'content' => $comment['content'],
            ]);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $dataUpdate = [
            'id' => $request['comment_id'],
            'content' => $request['content'],
        ];

        $this->commentRepository->updateComment($dataUpdate);

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->commentRepository->deleteComment($request['comment_id']);

        // if($request->ajax()) {
        //     return response()->json([

        //     ]);
        // }
        // return back();

        return response()->json();
    }

    public function more(Request $request) 
    {
        $commentId = $request['comment_id']; 
        
        $comment = $this->commentRepository->findComment($commentId); 

        if($request->ajax()) {
            return response()->json([
                'content' => $comment['content'],
            ]);
        }
        return back();
    }
}
