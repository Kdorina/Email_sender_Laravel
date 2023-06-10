<?php

namespace App\Mail;
use App\Mail\ContactMessage;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;
    public $contactData;
    /**
     * Create a new message instance.
     */
    public function __construct( $contactData )
    {
        $this->contactData = $contactData;
    }

    public function build(){
         return $this->markdown('emails.contact.message')
        ->with([
            'name' => $this->contactData['name'],
            'email' => $this->contactData['email'],
            'subject' => $this->contactData['subject'],
            'message' => $this->contactData['message'],
        ])
        ->subject('New Contact Message');
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Message',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact.message',
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
