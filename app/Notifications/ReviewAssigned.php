<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewAssigned extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have been assigned a new review.')
                    ->action('View Review', url('/reviews'))
                    ->line('Thank you for your contribution!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'You have been assigned a new review.',
            'url' => url('/reviews'),
        ];
    }
}