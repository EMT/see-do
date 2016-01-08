<?php

namespace App\Events;

use App\Event as EventResource;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventPosted extends Event
{
    use SerializesModels;

    public $event;

    /**
     * Create a new event instance.
     *
     * @param  Event  $event
     * @return void
     */
    public function __construct(EventResource $event)
    {
        $this->event = $event;
    }

}
