<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreationLivreur extends Notification
{
    use Queueable;
    private $donnee;
    /**
     * Create a new notification instance.
     */
    public function __construct($donnee)
    {
        $this->donnee=$donnee;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'data' => "Un nouveau livreur ".$this->donnee['nom']." vient de creer un compte. Veuillez verifier votre espace livreur"
        ];
    }
}
