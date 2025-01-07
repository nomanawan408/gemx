<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AccommodationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $accommodation;

    /**
     * Create a new message instance.
     *
     * @param $accommodation
     */
    public function __construct($accommodation)
    {
        $this->accommodation = $accommodation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Accommodation Created', // Subject of the email
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.accommodation-created', // Email view file
            with: [
                'accommodation' => $this->accommodation, // Pass the accommodation data to the view
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
