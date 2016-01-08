<?php

namespace App\Listeners;

use Log;
use Twitter;
use App\Events\SocialBroadcastEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TweetSender
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
     * @param  SocialBroadcastEvent  $event
     * @return void
     */
    public function handle(SocialBroadcastEvent $eventPosted)
    {
        // Log::info('Fired event for new event [EVENT INFO]: '.$eventPosted->event);
        // Log::info('Fired event for new event [REQUEST INFO]: '.$eventPosted->request);
        $request = $eventPosted->request;
        $event = $eventPosted->event;

        if ($request->request->get('tweet') == true) {
            $this->tweet($event);
        }
    }

    private function tweet($event) {
        $title = $event->title;
        $date = date('d/m/y', strtotime($event->time_start));
        $time = date('g.ia', strtotime($event->time_start));
        $venue = explode(",", $event->venue)[0];
        $link = route('events.show', ['slug' => $event->slug]);

        Twitter::postTweet(array('status' => $title . ' : ' . $date . ' - '. $time .' at '. $venue . ' ' . $link, 'format' => 'json'));
        Log::info($title . ' on ' . $date . ' - '. $time .' at '. $venue . ' : ' . $link);
    }
}
