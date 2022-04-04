<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CommonRepository;

class HomepageController extends Controller
{
    protected $commonRepository; 

    public function __construct(CommonRepository $commonRepository)
    {
        $this->commonRepository = $commonRepository; 
    }

    public function index()
    {
        $posts = $this->commonRepository->concatUserAndPost(); 
        
        return view('auth.post.viewPosts', compact('posts'));
    }
}
