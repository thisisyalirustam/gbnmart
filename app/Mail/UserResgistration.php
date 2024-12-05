<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserResgistration extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $date;
    public $sub;


    /**
     * Create a new message instance.
     */
    public function __construct($username,$useremail,$create_date,$subject)
    {
        $this->name=$username;
        $this->email=$useremail;
        $this->date=$create_date;
        $this->sub=$subject;
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thanks For Joing Us'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.buyermails.registration',
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
