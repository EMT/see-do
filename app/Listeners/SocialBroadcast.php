<?php

namespace App\Listeners;

use Log;
use App\Events\EventPosted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SocialBroadcast
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
     * @param  EventPosted  $event
     * @return void
     */
    public function handle(EventPosted $event)
    {
        Log::info('Fired event for new event: '.$event->event);

        // Add in the twitter/facebook broadcast options
    }
}
