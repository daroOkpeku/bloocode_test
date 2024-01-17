<?php

namespace App\Listeners;

use App\Events\userevent;
use App\Mail\Sendemail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class userlistener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(userevent $event): void
    {
        $data = [
            'firstname'=>$event->firstname,
            'lastname'=>$event->lastname,
            'email'=>$event->email
        ];

         Mail::to($event->email)->send( new Sendemail($data));
    }
}
