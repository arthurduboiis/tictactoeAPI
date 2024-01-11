<?php

use App\Models\Party;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;

class PartyChannel implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $party;

    public function __construct(Party $party)
    {
        $this->party = $party;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('party.'.$this->party->id);
    }
}