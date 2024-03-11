<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
// use Illuminate\Mail\Mailables\Content;
// use Illuminate\Mail\Mailables\Envelope;
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
        // return $this->subject('本日' . $this->today . 'に' . $this->reservation->name . 'での予約があります。')->view('emails.reservation_reminder')->with([
        //     'shopName' => $this->reservation->shop->name,
        // ]);
        return $this->subject('本日のご予約について')
                ->view('emails.reservation_reminder');
    }
    // /**
    //  * Get the message envelope.
    //  */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Reservation Reminders Mail',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // /**
    //  * Get the attachments for the message.
    //  *
    //  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    //  */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
