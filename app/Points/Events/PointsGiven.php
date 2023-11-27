<?php

namespace App\Points\Events;

use App\Points\Models\Point;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PointsGiven implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    public $point;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Point $point)
    {
        $this->user = $user;
        $this->point = $point;
    }

    public function broadcastAs()
    {
        return 'points-given';
    }

    public function broadcastWith()
    {
        return [
            'point' => $this->point,
            'user_points' => [
                'number' => $this->user->points()->number(),
                'shorthand' => $this->user->points()->shorthand(),
            ]
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('users.' . $this->user->id);
    }
}
