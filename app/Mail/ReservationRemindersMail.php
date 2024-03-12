<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationRemindersMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $today;
    public $shopName;

    /**
     * Create a new message instance.
     */
    public function __construct($reservation, $today, $shopName)
    {
        $this->reservation = $reservation;
        $this->today = $today;
        $this->shopName = $shopName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('本日のご予約について')
                ->view('emails.reservation_reminder');
    }
}
