<?php

namespace App\Events;

use App\Event as EventResource;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;

class SocialBroadcastEvent extends Event
{
    use SerializesModels;

    public $event;

    /**
     * Create a new event instance.
     *
     * @param Event $event
     *
     * @return void
     */
    public function __construct(EventResource $event, Request $request)
    {
        $this->event = $event;
        $this->request = $request;
    }

}
