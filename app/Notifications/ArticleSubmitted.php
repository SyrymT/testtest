<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ArticleSubmitted extends Notification
{
    use Queueable;

    protected $article;

    public function __construct($article)
    {
        $this->article = $article;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new article has been submitted.')
                    ->action('View Article', url('/articles/'.$this->article->id))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'article_id' => $this->article->id,
            'title' => $this->article->title,
        ];
    }
}