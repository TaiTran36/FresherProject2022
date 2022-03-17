<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function loginPost(Request $request) {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboards');
        }else{
            echo "Dang nhap loi";exit;
        }
    }
    
    public function dashboards(){
        $adminUser = Auth::guard('admin')->user();
        return view('admin.dashboards',['user'=>$adminUser]);
    }
    
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
    public function users_list(){
        $adminUser = Auth::guard('admin')->user();
        return view('admin.users_list',['user'=>$adminUser]);
    }

}
