<?php

namespace App\Http\Controllers\Auth;

use App\Events\DashboardProfileEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepositories;
use Pusher\Pusher;

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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(RegisterRequest $request)
    {
        $data = $request->all();
        $profileImage = $request->file('avatar');
        $profileImageSaveAsName = time() .rand(99,99999)."-".$profileImage->getClientOriginalName();
   
        $upload_path = '../public/profile/';
        $profile_image_url = $profileImageSaveAsName;
        $profileImage->move($upload_path, $profileImageSaveAsName);
        $userRepository= new UserRepositories ;
        $user=$userRepository->create($request,$profile_image_url );
        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        event(new DashboardProfileEvent());
        return redirect('/dashboard');
}

    
}