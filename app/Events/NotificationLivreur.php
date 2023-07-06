<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationLivreur implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $nom;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($nom)
    {
        $this->nom = $nom;
        $this->message  = "Un nouveau livreur {$nom} vient de créer un compte";
    }

    public function broadcastOn()
  {
      return ['my-channel'];
  }

  public function broadcastAs()
  {
      return 'my-event';
  }

}
