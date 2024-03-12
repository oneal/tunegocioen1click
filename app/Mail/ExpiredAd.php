<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpiredAd extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $days;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $days)
    {
        $this->data = $data;
        $this->days = $days;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address(config('mail.from.address_info'), config('mail.from.name')),
            replyTo: [
                new Address(config('mail.from.address_info'), config('mail.from.name')),
            ],
            subject: config('mail.from.name').' - Pronto va a caducar tu anuncio',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'web.email.expired_ad',
            with: [
                'data' => $this->data,
                'days' => $this->days
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
