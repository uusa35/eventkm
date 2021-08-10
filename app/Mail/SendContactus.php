<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactus extends Mailable
{
    use Queueable, SerializesModels;
    protected $request;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contactus')->with([
            'name' => $this->request['name'],
            'email' => $this->request['email'],
            'title' => $this->request['title'],
            'inquiry_type' => $this->request['inquiry_type'],
            'body' => $this->request['body'],
        ]);
    }
}
