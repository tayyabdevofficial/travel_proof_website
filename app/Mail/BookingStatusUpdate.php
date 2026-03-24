<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\BookingUpdate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Booking $booking,
        public BookingUpdate $update
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Update - ' . strtoupper($this->booking->tracking_id)
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-status-update',
            with: [
                'booking' => $this->booking,
                'update' => $this->update,
            ]
        );
    }

    public function attachments(): array
    {
        $attachments = [];
        $files = $this->update->attachments ?? [];

        foreach ($files as $file) {
            if (empty($file['path']) || !\Illuminate\Support\Facades\Storage::disk('local')->exists($file['path'])) {
                continue;
            }
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromStorageDisk('local', $file['path'])
                ->as($file['name'] ?? basename($file['path']));
        }

        return $attachments;
    }
}
