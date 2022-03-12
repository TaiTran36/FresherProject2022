<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'date_of_birth'=> ['required','date'],
            'nickname'=> ['required', 'string', 'max:255'],
            'description'=> ['required', 'string'],
            'address'=> ['required', 'string'],
            'phone_number'=> ['required', 'string', 'max:11'],
            'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();

        $profileImage = $request->file('avatar');
        $profileImageSaveAsName = time() .rand(99,99999) . "-profile." . $profileImage->getClientOriginalExtension();
   
        $upload_path = '../storage/app/public/profile_images/';
        $profile_image_url = $upload_path . $profileImageSaveAsName;
        $success = $profileImage->move($upload_path, $profileImageSaveAsName);
   
         return User::create([
            'name' => $data['name'],
            'username_login' => $data['username'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'date_of_birth'=> $data['date_of_birth'],
            'description'=> $data['description'],
            'address'=> $data['address'],
            'phone_number'=> $data['phone_number'],
            'avatar' => $profile_image_url,
        ]);
    }
}
