<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportExceptionMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     */
    public function __construct(private $message, private $trace)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Exception Occurred',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // dd(3, $this->message);
        return new Content(
            view: 'email.exceptions.report',
            text: 'email.exceptions.report-raw',
            with: [
                'messageAsString' => $this->message,
                'traceAsString' => $this->trace,
            ],
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
