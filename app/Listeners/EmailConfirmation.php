<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

use Illuminate\Support\Facades\Mail;
class EmailConfirmation
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $user)
    {

        $st=Mail::send([],[], function($message) use($user) {
            $message->to($user->user->email, $user->user->fname.' '.$user->user->lname)
                ->subject('Welcome to the Laravel 4 Auth App!')
                ->setBody('Thankyou For Registration. NOW You Can Login Click on Link And Activate Your Account  '.PHP_EOL.url('register/'.$user->user->user_id));
        });

    }
}
