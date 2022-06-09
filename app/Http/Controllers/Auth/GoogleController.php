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

class GoogleController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = $this->userRepository->findUserByGoogleId($googleUser->id);

            if (!empty($user)) {
                auth()->login($user);

                return redirect()->intended('home');
            } 
            else {
                $dataInsert = [
                    'username_login' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(random_bytes(8)),
                    'google_id' => $googleUser->id,
                ];

                $newUser = $this->userRepository->createUser($dataInsert);

                auth()->login($newUser);

                return redirect()->intended('home');
            }
        } catch (Exception $e) {
            //throw $th;
        }
    }
}
