<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Notifications\Notice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class Ajax extends Controller
{
    public function comment(Request $request){
        
    }

    public function sendTestNotification(){
        $user = User::first();
        $enrollmentData = [
            'body' => 'new noti',
            'enrollmentText' => 'you are allow to anroll ',
            'url' => url('/'),
            'thankyou' => 'you have 14 day enroll'
        ];
        $user->notify(new Notice($enrollmentData));
        
    }
}
