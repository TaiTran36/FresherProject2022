<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Carbon\Carbon;
use App\Repositories\UserRepository; 


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $userRepository; 
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth'); 
        $this->userRepository = $userRepository; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$this->userCan('view-list-user'))  abort('403', __('Access denied'));

        $data = [];
        if(isset($request['search-user'])) {
            $data['search'] = $request->input('search-user'); 
        }

        $users = $this->userRepository->getListUser($data); 

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
    public function edit($userId)
    { 
        // $username_login = $user->username_login;
        $user = $this->userRepository->findUser('id', $userId); 
        $fields = array("name" => "Name", "username_login" => "Username", "nickname" => "Nickname", 'birth_of_date' => "Birthday", 
                "email" => "Email", "address" => "Address", "phone_number" => "Phone number", "photo_url" => "Profile picture", ); 
        
        return view('auth.user.editUser', compact('user', 'fields'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $dataUpdate = [
            'id' => $request['id'],
            'name' => $request['name'],  
            'username_login' => $request['username_login'], 
            'nickname' => $request['nickname'], 
            'birth_of_date' => $request['birth_of_date'], 
            'email' => $request['email'], 
            'address' => $request['address'], 
            'phone_number' => $request['phone_number'], 
        ]; 

        if($request->hasFile('photo_url')) {
            $oldPhoto = $user->photo_url; 
            if($oldPhoto != "default-profile.png")
                File::delete(public_path().'/images/'. $oldPhoto); 

            $image = $request->photo_url; 
            $image_name = $image->hashName(); 
            $image->move(public_path('/images'), $image_name); 
            $dataUpdate['photo_url'] = $image_name; 
        }

        $this->userRepository->updateUser($dataUpdate); 

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
