<?php

namespace App\Listeners;

use Log;
use Twitter;
use App\City;
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
        $city = City::where('id','=',$event->city_id)->first();
        $title = $event->title;
        $date = date('d/m/y', strtotime($event->time_start));
        $time = date('g.ia', strtotime($event->time_start));
        $venue = explode(",", $event->venue)[0];
        $link = route('{city}.events.show', ['city' => $city->iata, 'slug' => $event->slug]);
        $status = $title . ' - ' . $date . ' - '. $time .' at '. $venue . '. ' . $link;

        Twitter::reconfig([
            'consumer_key' => $city->twitter_consumer_key,
            'consumer_secret' => $city->twitter_consumer_secret,
            'token' => $city->twitter_access_token,
            'secret' => $city->twitter_access_token_secret
        ]);

        // YOU WERE ABOUT TO: Test the NYC twitter account and see if it changes the details.

        Twitter::postTweet(array('status' => $status, 'format' => 'json'));
        Log::info($status);
    }
}
