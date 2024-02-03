<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Queue\SerializesModels;

class UserJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $gameCode;

    public function __construct(User $user, $gameCode)
    {
        $this->user = $user;
        $this->gameCode = $gameCode;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('tictactoe.'.$this->gameCode),
        ];
    }
}