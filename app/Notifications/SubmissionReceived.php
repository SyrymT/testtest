<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubmissionReceived extends Notification
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
                    ->line('Your submission has been received.')
                    ->action('View Submission', url('/submissions'))
                    ->line('Thank you for your submission!');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Your submission has been received.',
            'url' => url('/submissions'),
        ];
    }
}