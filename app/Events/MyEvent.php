<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $id;

    public function __construct($message, $id = '')
    {
        $this->message = $message;
        $this->id = $id;
    }

    public function broadcastOn()
    {
        if (env('ENABLE_PUSHER')) {
            return ['my-channel'];
        }
    }

    public function broadcastAs()
    {
        if (env('ENABLE_PUSHER')) {
            return 'my-event';
        }
    }
}
