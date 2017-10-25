<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class InnovationCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $innovation;
    /**
     * Create a new event instance.
     *
     * @return void
     */
     public function __construct($user, $innovation)
    {
        $this->user = $user;
        $this->innovation = $innovation;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('innovationadded');
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'innovation' => $this->innovation
        ];
    }
}
