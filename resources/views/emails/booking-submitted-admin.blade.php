@php
    $appName = config('app.name');
@endphp

<h2 style="margin:0 0 12px; font-family: Arial, sans-serif;">New Booking Submitted</h2>
<p style="margin:0 0 12px; font-family: Arial, sans-serif;">
    Tracking ID: <strong>{{ $booking->tracking_id }}</strong>
</p>
<ul style="margin:0 0 12px; padding-left:18px; font-family: Arial, sans-serif;">
    <li>Name: {{ $booking->full_name }}</li>
    <li>Email: {{ $booking->email }}</li>
    <li>Phone: {{ $booking->phone }}</li>
    <li>Type: {{ ucfirst($booking->booking_type) }}</li>
    <li>Total: NGN {{ number_format($booking->total_amount, 0) }}</li>
</ul>
<p style="margin:0; font-family: Arial, sans-serif;">
    Please log in to the admin panel to manage this booking.
</p>
