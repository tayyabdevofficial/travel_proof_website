<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BookingStatusUpdate;
use App\Models\Booking;
use App\Models\BookingUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($builder) use ($q) {
                $builder->where('tracking_id', 'like', "%{$q}%")
                    ->orWhere('full_name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if ($request->filled('preset')) {
            $preset = $request->string('preset')->toString();
            if ($preset === 'last7') {
                $query->where('created_at', '>=', now()->subDays(6)->startOfDay());
            } elseif ($preset === 'thismonth') {
                $query->where('created_at', '>=', now()->startOfMonth());
            }
        } else {
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->date('start_date'));
            }

            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->date('end_date'));
            }
        }

        $sort = $request->string('sort', 'latest');
        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('updates');

        return view('admin.bookings.show', compact('booking'));
    }

    public function storeUpdate(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,processing,rejected,refunded,completed'],
            'message' => ['nullable', 'string', 'max:2000'],
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
                $newName = $booking->id . '_' . $timestamp . $suffix . $ext;
                $path = $file->storeAs('booking-updates', $newName, 'local');
                $attachments[] = [
                    'name' => $newName,
                    'path' => $path,
                ];
                $index++;
            }
        }

        $booking->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['message'] ?? $booking->admin_notes,
        ]);

        $update = BookingUpdate::create([
            'booking_id' => $booking->id,
            'admin_id' => $request->user()?->id,
            'status' => $validated['status'],
            'message' => $validated['message'] ?? null,
            'attachments' => $attachments ?: null,
        ]);

        Mail::to($booking->email)->send(new BookingStatusUpdate($booking, $update));

        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('status', 'Booking updated and customer notified.');
    }

    public function downloadAttachment(Booking $booking, BookingUpdate $update, int $index)
    {
        if ($update->booking_id !== $booking->id) {
            abort(404);
        }

        $files = $update->attachments ?? [];
        $file = $files[$index] ?? null;

        if (!$file || empty($file['path'])) {
            abort(404);
        }

        $disk = Storage::disk('local');
        $path = str_replace('\\', '/', $file['path']);
        $root = str_replace('\\', '/', $disk->path(''));
        if (str_starts_with($path, $root)) {
            $path = ltrim(substr($path, strlen($root)), '/');
        }
        $path = preg_replace('#^storage/app/private/#', '', $path);
        if (!$disk->exists($path)) {
            $legacyPath = ltrim($path, '/');
            $legacyPath = preg_replace('#^private/#', '', $legacyPath);
            if ($disk->exists($legacyPath)) {
                $path = $legacyPath;
            } else {
                abort(404);
            }
        }
        $fullPath = $disk->path($path);
        if (!is_file($fullPath)) {
            abort(404);
        }

        $filename = $file['name'] ?? basename($path);
        $mime = $disk->mimeType($path) ?: 'application/octet-stream';

        return $disk->download($path, $filename, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'attachment; filename="' . addslashes($filename) . '"',
        ]);
    }
}
