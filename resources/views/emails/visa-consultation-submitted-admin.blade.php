@php
    $appName = config('app.name');
@endphp

<h2 style="margin:0 0 12px; font-family: Arial, sans-serif;">New Visa Consultation Request</h2>
<ul style="margin:0 0 12px; padding-left:18px; font-family: Arial, sans-serif;">
    <li>Name: {{ $consultation->full_name }}</li>
    <li>Email: {{ $consultation->email }}</li>
    <li>Phone: {{ $consultation->phone }}</li>
    <li>Nationality: {{ $consultation->nationality }}</li>
    <li>Destination: {{ $consultation->destination_country }}</li>
    <li>Visa Type: {{ ucfirst($consultation->visa_type) }}</li>
    <li>Travel Date: {{ $consultation->travel_date->format('M d, Y') }}</li>
</ul>
@if ($consultation->special_note)
    <div style="margin:16px 0; padding:16px; border:1px solid #e5e7eb; border-radius:8px; font-family: Arial, sans-serif;">
        {!! nl2br(e($consultation->special_note)) !!}
    </div>
@endif
<p style="margin:0; font-family: Arial, sans-serif;">
    Please log in to the admin panel to reply.
</p>
