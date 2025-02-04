<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FranchiseCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $franchise;  // Make the franchise property public
    /**
     * Create a new message instance.
     */
    public function __construct($franchise)
    {
        $this->franchise = $franchise;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('email.franchise_created')
                    ->subject('Franchise Created Successfully')
                    ->with(['franchise' => $this->franchise]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Franchise Created',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
