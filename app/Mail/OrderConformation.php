<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderConformation extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $total;
    public $address;
    public $phone;
    public $subtotal;
    public $items;
    public $pyment;
    public $date;
    public $subject;

    /**
     * Create a new message instance.
     */
    public function __construct($username, $useremail, $useradress, $grandTotal, $userphone, $subtotal, $method)
    {
        //$username, $useremail, $useradress, $grandTotal, $userphone
        $this->name=$username;
        $this->email=$useremail;
        $this->address=$useradress;
        $this->phone=$userphone;
        $this->total=$grandTotal;
        $this->subtotal=$subtotal;
        $this->pyment=$method;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Order Conformation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.buyermails.orderConfrim',
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
