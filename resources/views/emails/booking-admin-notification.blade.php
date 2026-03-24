<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>New Booking Payment</title>
    </head>
    <body style="font-family: Arial, sans-serif; color: #1f2937">
        <h2>New Booking Payment</h2>
        <p>
            Tracking ID: <strong>{{ $booking->tracking_id }}</strong>
        </p>

        <h3>Customer Details</h3>
        <ul>
            <li>Name: {{ $booking->full_name }}</li>
            <li>Email: {{ $booking->email }}</li>
            <li>Phone: {{ $booking->phone }}</li>
        </ul>

        <h3>Booking Summary</h3>
        <ul>
            <li>Type: {{ ucfirst($booking->booking_type) }}</li>
            <li>Total: NGN {{ number_format($booking->total_amount, 0) }}</li>
            <li>Payment Method: {{ strtoupper($booking->payment_provider ?? $booking->payment_method ?? '-') }}</li>
            <li>Payment Status: {{ ucfirst($booking->payment_status) }}</li>
            @if ($booking->payment_reference)
                <li>Payment Reference: {{ $booking->payment_reference }}</li>
            @endif
            <li>Receive: {{ $booking->receive_timing === 'later' ? 'Later' : 'Now' }}</li>
        </ul>

        <p>
            Track booking:
            <a href="{{ route('track.show', $booking->tracking_id) }}">View tracking</a>
        </p>
    </body>
</html>
