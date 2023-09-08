<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Planta;
use App\Models\User;

class FirstPlantaCreated{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $planta, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Planta $planta, User $user){
        $this->planta = $planta;
        $this->user = $user;//
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
