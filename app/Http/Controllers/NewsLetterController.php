<?php

namespace App\Http\Controllers;

use App\Events\UseSubscribe;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use App\Repositories\PostRepositories;
use App\Repositories\CategoryRepositories;
use Illuminate\Support\Facades\Mail;

class NewsLetterController extends Controller
{
    public function __construct(PostRepositories $postRepository, CategoryRepositories $CategoryRepository)
    {
        $this->postRepository = $postRepository;
        $this->CategoryRepositories = $CategoryRepository;       
    }
    public function subscribe(Request $request){
        event(new UseSubscribe($request->input('email')));
        return back();
    }
    public function subscribed(Request $request){
        $this->postRepository->update_follow($request);
        return back();
    }
    public function unsubscribed(Request $request){
        $this->postRepository->destroy_follow($request);
        return back();
    }
    public function tattb(Request $request){
        $this->postRepository->tattb($request);
        return back();
    }public function battb(Request $request){
        $this->postRepository->battb($request);
        return back();
    }

}
