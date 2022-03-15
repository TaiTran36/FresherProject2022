<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Carbon\Carbon;


class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->userCan('view-list-user'))  abort('403', __('Access denied'));
        $users = User::orderBy('name')->paginate(10); 
        if(request('search')) {
            $search = $request->input('search');
            $users = User::where('name', 'LIKE', "%{$search}%")->orderBy('name')->get();
        }
        $fields = array("name" => "Name", "photo_url" => "Avatar", "email" => "Email", "phone_number" => "Phone number", "action" => "Action");
        return view('auth.user.listUser', compact('users', 'fields'))
            ->with('i', (request()->input('page', 1) - 1) * 10); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit(User $user)
    {
        $username_login = $user->username_login;
        $fields = array("name" => "Name", "username_login" => "Username", "nickname" => "Nickname", 'birth_of_date' => "Birthday", 
                "email" => "Email", "address" => "Address", "phone_number" => "Phone number", "photo_url" => "Profile picture", ); 
        return view('auth.user.editUser', compact('user', 'username_login', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->name; 
        $user->username_login = $request->username_login; 
        $user->nickname = $request->nickname; 
        $user->birth_of_date = $request->birth_of_date; 
        $user->email = $request->email; 
        $user->address = $request->address; 
        $user->phone_number = $request->phone_number; 

        if($request->hasFile('photo_url')) {
            $oldPhoto = $user->photo_url; 
            if($oldPhoto != "default-profile.png")
                File::delete(public_path().'/images/'. $oldPhoto); 

            $image = $request->photo_url; 
            $image_name = $image->hashName(); 
            $image->move(public_path('/images'), $image_name); 
            $user->photo_url = $image_name; 
        }

        $user->update($request->all()); 

        return redirect()->route('user.search')
            ->with('success', 'User updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
