@php
    $appName = config('app.name');
@endphp

<h2 style="margin:0 0 12px; font-family: Arial, sans-serif;">New Contact Message</h2>
<ul style="margin:0 0 12px; padding-left:18px; font-family: Arial, sans-serif;">
    <li>Name: {{ $contactMessage->name }}</li>
    <li>Email: {{ $contactMessage->email }}</li>
    <li>Phone: {{ $contactMessage->phone ?: '-' }}</li>
    <li>Subject: {{ str_replace('-', ' ', $contactMessage->subject) }}</li>
</ul>
<div style="margin:16px 0; padding:16px; border:1px solid #e5e7eb; border-radius:8px; font-family: Arial, sans-serif;">
    {!! nl2br(e($contactMessage->message)) !!}
</div>
<p style="margin:0; font-family: Arial, sans-serif;">
    Please log in to the admin panel to reply.
</p>
