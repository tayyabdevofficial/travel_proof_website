<?php

namespace App\Mail;

use App\Models\VisaConsultation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisaConsultationPaymentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public VisaConsultation $consultation)
    {
    }

    public function build(): self
    {
        return $this
            ->cc(config('site.support_email', 'support@travelproof.ng'))
            ->subject('Visa Consultation Payment Confirmed - ' . $this->consultation->tracking_id)
            ->view('emails.visa-consultation-payment-confirmation');
    }
}
