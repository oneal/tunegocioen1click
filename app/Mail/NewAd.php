<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAd extends Mailable
{
    use Queueable, SerializesModels;

    private $invoice;
    private $invoiceLine;
    private $config;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invoice, $invoceLine)
    {
        $this->invoice = $invoice;
        $this->invoiceLine = $invoceLine;
        $this->config = config('transfer');
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
            subject: config('mail.from.name').' - Compra de ficha destacada',
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
            view: 'web.email.new_ad',
            with: [
                'invoice' => $this->invoice,
                'invoiceLine' => $this->invoiceLine,
                'config' => $this->config
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
