<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReturnPolicyMail extends Mailable
{
    use Queueable, SerializesModels;

     public $total;
    public $orderDate;
    public $buyerName;
    public $buyerPhone;
    public $buyerEmail;
    public $buyerAddress;
    public $orderid;

    /**
     * Create a new message instance.
     *
     * @param float $total
     * @param string $orderDate
     * @param string $buyerName
     * @param string $buyerAddress
     * @param string $buyerPhone
     * @param string $buyerEmail
     * @param string $orderid
     */
    public function __construct($total, $orderDate, $buyerName, $buyerAddress, $buyerPhone, $buyerEmail, $orderid)
    {
        $this->total = $total;
        $this->orderDate = $orderDate;
        $this->buyerName = $buyerName;
        $this->buyerPhone = $buyerPhone;
        $this->buyerAddress = $buyerAddress;
        $this->buyerEmail = $buyerEmail;
        $this->$orderid = $orderid;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Return Policy Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.order_mail.order_return',
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
