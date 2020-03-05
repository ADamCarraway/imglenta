<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class CreateFeed
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->feeds()->create([
            'title' => 'Название',
            'info' => 'Описание'
        ]);
    }
}
