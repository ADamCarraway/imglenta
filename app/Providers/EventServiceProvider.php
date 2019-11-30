<?php

namespace App\Providers;

use App\Events\PhotoCreated;
use App\Listeners\CreateFeed;
use App\Listeners\SendEmailNewPhoto;
use App\Listeners\SendWelcomeEmail;
use App\Notifications\HaveNewPhotoEmal;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendWelcomeEmail::class,
            CreateFeed::class
        ],
        PhotoCreated::class => [
            SendEmailNewPhoto::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
