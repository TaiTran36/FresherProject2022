<?php

namespace App\Http\Controllers;

use Auth; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (Auth::user()->role == 1 || Auth::user()->role == 2) 
        // {
        //     return redirect()->route('user.search'); 
        // }
        // else if (Auth::user()->role == 3) 
        // {
        //     return view('homeOld'); 
        // }
        
        return redirect()->route('post.view'); 
    }
}
