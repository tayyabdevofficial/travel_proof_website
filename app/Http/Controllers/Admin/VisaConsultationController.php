<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisaConsultation;
use App\Models\VisaConsultationReply;
use App\Mail\VisaConsultationReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class VisaConsultationController extends Controller
{
    public function index()
    {
        $query = VisaConsultation::query();

        if (request()->filled('q')) {
            $q = request()->string('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('full_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%")
                    ->orWhere('destination_country', 'like', "%{$q}%");
            });
        }

        if (request()->filled('visa_type')) {
            $query->where('visa_type', request()->string('visa_type'));
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

        $consultations = $query->paginate(10)->withQueryString();

        return view('admin.visa-consultations.index', compact('consultations'));
    }

    public function show(VisaConsultation $visaConsultation)
    {
        $visaConsultation->load('replies');

        return view('admin.visa-consultations.show', compact('visaConsultation'));
    }

    public function storeReply(Request $request, VisaConsultation $visaConsultation)
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
                $newName = $visaConsultation->id . '_' . $timestamp . $suffix . $ext;
                $path = $file->storeAs('visa-consultation-replies', $newName, 'local');
                $attachments[] = [
                    'name' => $newName,
                    'path' => $path,
                ];
                $index++;
            }
        }

        $reply = VisaConsultationReply::create([
            'visa_consultation_id' => $visaConsultation->id,
            'admin_id' => $request->user()?->id,
            'message' => $validated['message'],
            'attachments' => $attachments ?: null,
        ]);

        Mail::to($visaConsultation->email)
            ->send(new VisaConsultationReplyMail($visaConsultation, $reply));

        return redirect()
            ->route('admin.visa-consultations.show', $visaConsultation)
            ->with('status', 'Reply sent to applicant.');
    }

    public function downloadAttachment(VisaConsultation $visaConsultation, VisaConsultationReply $reply, int $index)
    {
        if ($reply->visa_consultation_id !== $visaConsultation->id) {
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
