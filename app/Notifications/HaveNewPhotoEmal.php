<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class HaveNewPhotoEmal extends Notification
{
    use Queueable;

    public $feed;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($feed)
    {
        $this->feed = $feed;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('In te feed ' . $this->feed->title . 'a new photo.');
    }
}