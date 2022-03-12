<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {

        // $users = Profile::paginate(10);
        // //return $users;
        // return view('admin.dashboard', compact('users'));
        $role=Profile::where('id',Auth::id())->pluck('role_id');
       
        foreach($role as $value){
            $role_id=$value;
        }
        if($role_id==1){
            $users = Profile::with('role')
        ->get();
        $list=Role::get();
        }else
        if($role_id==2){
            $users = Profile::with('role')->where('role_id','<>',1)
        ->get();
        $list=Role::where('id','<>',1)->get();
        }else{
            $users = Profile::with('role')->where('role_id', $role_id)
            ->get();
            $list=Role::where('id', $role_id)->get();
        }
        
        $data=[
            'menu'=>$list,
            'data'=>$users,
            'auth_id'=>$role_id,
        ];
    
        
        return view('admin.dashboard', compact('data'));
    }
}
