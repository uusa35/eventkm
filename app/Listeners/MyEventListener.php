<?php

namespace App\Listeners;

use App\Events\MyEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class MyEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(MyEvent $event)
    {
        // New Pusher instance with our config data
        $pusher = new \Pusher\Pusher(config('broadcasting.connections.pusher.key'), config('broadcasting.connections.pusher.secret'), config('broadcasting.connections.pusher.app_id'), config('broadcasting.connections.pusher.options'));
      // Enable pusher logging - I used an anonymous class and the Monolog
        $pusher->set_logger(new class
        {
            public function log($msg)
            {
                \Log::info($msg);
            }
        });
        // Your data that you would like to send to Pusher
        $data = ['text' => 'hello world from Laravel 7'];
        $pusher->trigger('my-channel', 'my-event-' . $event->id, 'from Laravel 6.5 After Processing Data Sent ::: ->' . $event->message . '- current event Id id  is :' . $event->id);
    }
}
