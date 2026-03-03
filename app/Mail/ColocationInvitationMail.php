<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ColocationInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */


    public $invitation;

    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this->subject('You are invited to join a colocation')
            ->view('emails.invitation');
    }

    /**
     * Get the message envelope.
     */

    /**
     * Get the message content definition.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'You are invited to join a colocation',
    //     );
    // }

    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'emails.invitation', // correct view path
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}