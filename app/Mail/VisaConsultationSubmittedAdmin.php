<?php

namespace App\Mail;

use App\Models\VisaConsultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaConsultationSubmittedAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public VisaConsultation $consultation)
    {
    }

    public function build(): self
    {
        return $this
            ->subject('New Visa Consultation Request')
            ->view('emails.visa-consultation-submitted-admin');
    }
}
