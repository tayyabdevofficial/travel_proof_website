<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactMessageSubmittedAdmin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:500'],
        ]);

        $message = ContactMessage::create($validated);

        Mail::to(config('site.support_email', 'support@travelproof.ng'))
            ->send(new ContactMessageSubmittedAdmin($message));

        return back()->with('status', 'Thanks! Your message has been sent. We will get back to you shortly.');
    }
}
