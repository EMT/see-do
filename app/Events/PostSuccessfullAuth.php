<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class PostSuccessfullAuth extends Event
{
    use SerializesModels;

    public $token;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }
}
