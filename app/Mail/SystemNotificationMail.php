<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SystemNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $body;

    /**
     * Create a new message instance.
     */
    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails/system_notification')
                    ->subject($this->title)
                    ->with([
                        'title' => $this->title,
                        'body' =>$this->body,
                    ]);
    }
}
