<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class AdminController extends Controller
{
    //
    public function adminLogin(LoginRequest $request)
    {
        
        $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');
        // dd(Auth::attempt($data));
        if (Auth::attempt($data)) {
            // Success
            return redirect()->intended('admin/dashboard');
        } else {
            // Go back on error (or do what you want)
            return redirect()->back()->withErrors(['message'=> 'Email hoặc mật khẩu không đúng'])->withInput();
        }
    }
}
