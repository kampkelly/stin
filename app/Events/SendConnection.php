<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendConnection implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $auth;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $auth)
    {
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('sendconnection');
    }

    public function broadcastWith()
    {
        return [
            'user' => $this->user,
            'auth' => $this->auth
        ];
    }
}
