<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ScoreUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $teamA, $teamB;

    /**
     * Create a new event instance.
     */
    public function __construct($teamA, $teamB)
    {
        info('ScoreUpdated event constructed', [
            'teamA' => $teamA,
            'teamB' => $teamB,
        ]);
        
        $this->teamA = $teamA;
        $this->teamB = $teamB;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        info('ScoreUpdated broadcastOn triggered');
        return [
            new Channel('football.match'),
        ];
    }
}
