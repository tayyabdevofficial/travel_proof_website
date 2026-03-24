<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use App\Mail\ContactMessageReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $query = ContactMessage::query();

        if (request()->filled('q')) {
            $q = request()->string('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('subject', 'like', "%{$q}%");
            });
        }

        if (request()->filled('subject')) {
            $query->where('subject', request()->string('subject'));
        }

        if (request()->filled('preset')) {
            $preset = request()->string('preset')->toString();
            if ($preset === 'last7') {
                $query->where('created_at', '>=', now()->subDays(6)->startOfDay());
            } elseif ($preset === 'thismonth') {
                $query->where('created_at', '>=', now()->startOfMonth());
            }
        } else {
            if (request()->filled('start_date')) {
                $query->whereDate('created_at', '>=', request()->date('start_date'));
            }

            if (request()->filled('end_date')) {
                $query->whereDate('created_at', '<=', request()->date('end_date'));
            }
        }

        $sort = request()->string('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $messages = $query->paginate(10)->withQueryString();

        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        $contactMessage->load('replies');

        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function storeReply(Request $request, ContactMessage $contactMessage)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:3000'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
        ]);

        $attachments = [];
        if ($request->hasFile('attachments')) {
            $timestamp = now()->format('Ymd_His');
            $index = 1;
            foreach ($request->file('attachments') as $file) {
                $ext = $file->getClientOriginalExtension();
                $ext = $ext ? '.' . $ext : '';
                $suffix = $index > 1 ? '_' . $index : '';
                $newName = $contactMessage->id . '_' . $timestamp . $suffix . $ext;
                $path = $file->storeAs('contact-message-replies', $newName, 'local');
                $attachments[] = [
                    'name' => $newName,
                    'path' => $path,
                ];
                $index++;
            }
        }

        $reply = ContactMessageReply::create([
            'contact_message_id' => $contactMessage->id,
            'admin_id' => $request->user()?->id,
            'message' => $validated['message'],
            'attachments' => $attachments ?: null,
        ]);

        Mail::to($contactMessage->email)
            ->send(new ContactMessageReplyMail($contactMessage, $reply));

        return redirect()
            ->route('admin.contact-messages.show', $contactMessage)
            ->with('status', 'Reply sent to user.');
    }

    public function downloadAttachment(ContactMessage $contactMessage, ContactMessageReply $reply, int $index)
    {
        if ($reply->contact_message_id !== $contactMessage->id) {
            abort(404);
        }

        $file = ($reply->attachments ?? [])[$index] ?? null;
        if (!$file || empty($file['path'])) {
            abort(404);
        }

        $disk = Storage::disk('local');
        if (!$disk->exists($file['path'])) {
            abort(404);
        }

        $filename = $file['name'] ?? basename($file['path']);
        $mime = $disk->mimeType($file['path']) ?: 'application/octet-stream';

        return $disk->download($file['path'], $filename, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'attachment; filename="' . addslashes($filename) . '"',
        ]);
    }
}
