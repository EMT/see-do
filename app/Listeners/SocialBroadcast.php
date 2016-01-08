<?php

namespace App\Listeners;

use Log;
use Twitter;
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

        $event = $event->event;

        $title = $event->title;
        $date = date('d/m/y', strtotime($event->time_start));
        $time = date('g.ia', strtotime($event->time_start));
        $venue = explode(",", $event->venue)[0];
        $link = route('events.show', ['slug' => $event->slug]);

        // Twitter::postTweet(array('status' => $title . ' on ' . $date . ' - '. $time .' at '. $venue . ' : ' . $link, 'format' => 'json'));

        Log::info($title . ' on ' . $date . ' - '. $time .' at '. $venue . ' : ' . $link);

        // Add in the twitter/facebook broadcast options
    }
}
