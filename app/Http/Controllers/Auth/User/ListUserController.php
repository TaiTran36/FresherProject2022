<?php

namespace App\Http\Controllers\Auth\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ListUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUsers() 
    {
        if (!$this->userCan('view-list-user'))  abort('403', __('Access denied'));
        $fields = array("name" => "Name", "photo_url" => "Avatar", "email" => "Email", "phone_number" => "Phone number");
        $data = User::where('role', "!=", 1)->orderBy('name')->get();
        return view('auth.admin.listUser', compact('fields', 'data')); 
    } 

    public function getDetailUser($name) 
    {
        $user = User::where('name', $name)->get(); 
        return view('auth.admin.editUser', compact($user)); 
    }
}
