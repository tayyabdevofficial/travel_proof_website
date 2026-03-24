@php
    $appName = config('app.name');
@endphp

<h2 style="margin:0 0 12px; font-family: Arial, sans-serif;">Hello {{ $contactMessage->name }},</h2>
<p style="margin:0 0 12px; font-family: Arial, sans-serif;">
    We’ve replied to your message.
</p>
<div style="margin:16px 0; padding:16px; border:1px solid #e5e7eb; border-radius:8px; font-family: Arial, sans-serif;">
    {!! nl2br(e($reply->message)) !!}
</div>
<p style="margin:0; font-family: Arial, sans-serif;">
    If you have more questions, simply reply to this email.
</p>
<p style="margin-top:16px; font-family: Arial, sans-serif;">
    — {{ $appName }} Team
</p>
