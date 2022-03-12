<?php

namespace App\Http\Controllers\Auth\User;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    
    public function show() 
    {
        $fields = array("name" => "Name", "username_login" => "Username", "nickname" => "Nickname", 'birth_of_date' => "Birthday", 
                "email" => "Email", "address" => "Address", "phone_number" => "Phone number", "photo_url" => "Profile picture", ); 
        return view('auth.user.profile', compact('fields'));
    }

    public function update(Request $request) 
    {
        $request->validate([
            'name' => ['string', 'max: 50', 'nullable'],
            'username_login' => ['required', 'string', 'max:255'], 
            'nickname' => ['string', 'max: 20', 'nullable'], 
            'birth_of_date' => ['date_format:Y-m-d','after_or_equal:1930-01-01', 'before:today', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'address' => ['string', 'nullable'], 
            'phone_number' => ['digits:10', 'nullable'],
            'photo_url' => ['image', 'mimes:jpg,png,jpeg,gif,svg', 'max:2048', 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000', 'nullable'],
        ]);

        $user = Auth::user();
        $user->name = $request->name; 
        $user->username_login = $request->username_login; 
        $user->nickname = $request->nickname; 
        $user->birth_of_date = $request->birth_of_date; 
        $user->email = $request->email; 
        $user->address = $request->address; 
        $user->phone_number = $request->phone_number; 
        // $user->photo_url = $request->photo_url;
        $user->save();
        return back()->with('success', 'Profile updated'); 
    }
}
