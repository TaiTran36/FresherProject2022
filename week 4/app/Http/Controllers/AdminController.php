<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'           => 'required|max:255|email|confirmed',
            'password'           => 'required|min:8|confirmed',
        ],
        [
            'email.required' => 'Hãy nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.confirmed' => 'Email không tồn tại',
            'password.min' => 'Mật khẩu phải có ít nhất 8 kí tự',
            'password.confirmed' => 'Mật khẩu không đúng',
        ]
    
    );
        if (Auth::attempt(['email' => $request->email, 'password' =>$request->password])) {
            // Success
            return redirect()->intended('admin/dashboard');
        } else {
            // Go back on error (or do what you want)
            return redirect()->back();
        }
    }
}
