<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderFailed extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $settings;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order = null,$settings, $message = '')
    {
        $this->order = $order;
        $this->settings = $settings;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->markdown('emails.order-failed');
        $this->withSwiftMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('"Content-Type', 'text/html; charset=utf-8');
        });
    }
}
