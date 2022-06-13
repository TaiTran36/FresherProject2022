<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;
use App\Repositories\UserRepository; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class FacebookController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();

            $user = $this->userRepository->findUserByFacebookId($facebookUser->id);
            $tmpUser = $this->userRepository->findUserByEmail($facebookUser->email);
            
            if (!empty($user)) {
                auth()->login($user);
            } 
            else if (empty($user) && empty($tmpUser)){
                if (empty($facebookUser->email)) {
                    toastr()->error('You need an email to login!');
                    
                    return redirect()->intended('login');
                }

                $dataInsert = [
                    'username_login' => $facebookUser->name,
                    'email' => $facebookUser->email,
                    'password' => Hash::make(random_bytes(8)),
                    'facebook_id' => $facebookUser->id,
                ];

                $newUser = $this->userRepository->createUser($dataInsert);

                auth()->login($newUser);
            } 
            else if (empty($user) && !empty($tmpUser)) {
                $dataUpdate = [
                    'id' => $tmpUser->id,
                    'facebook_id' => $facebookUser->id,
                ];

                $this->userRepository->updateUser($dataUpdate);

                $tmpUser['facebook_id'] = $facebookUser->id;

                auth()->login($tmpUser);
            }

            return redirect('/#');
        } catch (Exception $e) {
            //throw $th;
        }
    }
}
