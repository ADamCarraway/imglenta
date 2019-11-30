<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class PhotoCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feed;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($feed)
    {
        $this->feed = $feed;
    }

}
