<?php

namespace App\Listeners;

use App\Events\UseSubscribe;
use App\Mail\UserSubscribeMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailOwnerAboutSubscription
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UseSubscribe $event)
    {
        DB::table('newletter')->insert([
            'email' => $event->email
        ]);
        Mail::to($event->email)->send(new UserSubscribeMessage);
    }
}
