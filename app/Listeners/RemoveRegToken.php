<?php

namespace App\Listeners;

use App\Token;
use Notification;
use App\Events\PostSuccessfullAuth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemoveRegToken
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
     * @param  PostSuccessfullAuth  $event
     * @return void
     */
    public function handle(PostSuccessfullAuth $event)
    {
        $storedToken = Token::where('token','=',$event->token)->first();
        $storedToken->delete();

        Notification::success('Registration successful, welcome to See+Do');

        return redirect('/');
    }
}
