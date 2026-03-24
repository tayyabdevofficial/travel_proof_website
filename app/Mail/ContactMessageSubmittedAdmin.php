<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageSubmittedAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $message)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('New Contact Message')
            ->view('emails.contact-message-submitted-admin')
            ->with([
                'contactMessage' => $this->message,
            ]);
    }
}
