<?php

namespace App\Mail;

use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailables\Attachment;

class ContactMessageReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ContactMessage $message,
        public ContactMessageReply $reply
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reply to your message'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-message-reply',
            with: [
                'contactMessage' => $this->message,
                'reply' => $this->reply,
            ]
        );
    }

    public function attachments(): array
    {
        $attachments = [];
        $files = $this->reply->attachments ?? [];

        foreach ($files as $file) {
            if (empty($file['path']) || !Storage::disk('local')->exists($file['path'])) {
                continue;
            }
            $attachments[] = Attachment::fromStorageDisk('local', $file['path'])
                ->as($file['name'] ?? basename($file['path']));
        }

        return $attachments;
    }
}
