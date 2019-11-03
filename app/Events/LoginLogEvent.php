<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LoginLogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $loginIp;

    public function __construct($userId, $loginIp)
    {
        $this->userId = $userId;
        $this->loginIp = $loginIp;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
