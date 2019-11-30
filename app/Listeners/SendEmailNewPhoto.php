<?php

namespace App\Listeners;

use App\Events\PhotoCreated;
use App\Notifications\HaveNewPhotoEmal;
use App\User;
use Illuminate\Support\Facades\Notification;

class SendEmailNewPhoto
{
    /**
     * Handle the event.
     *
     * @param PhotoCreated $event
     * @return void
     */
    public function handle(PhotoCreated $event)
    {
        $id_subs = $event->feed->subscribers()->pluck('user_id');
        $users = User::whereIn('id', $id_subs)->get();

        Notification::send($users, new HaveNewPhotoEmal($event->feed));
    }
}
