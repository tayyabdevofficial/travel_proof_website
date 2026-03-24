<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Booking Update</title>
    </head>
    <body style="font-family: Arial, sans-serif; color: #1f2937">
        <h2>Booking Update</h2>
        <p>
            Your booking (<strong>{{ $booking->tracking_id }}</strong>) has been updated.
        </p>
        <ul>
            <li>Status: {{ ucfirst($update->status ?? $booking->status) }}</li>
            <li>Booking Type: {{ ucfirst($booking->booking_type) }}</li>
        </ul>

        @if (!empty($update->message))
            <h3>Update Note</h3>
            <p>{{ $update->message }}</p>
        @endif

        @if (!empty($update->attachments))
            <h3>Attachments</h3>
            <p>Files are attached to this email.</p>
        @endif

        <p>
            Track your booking here:
            <a href="{{ route('track.show', $booking->tracking_id) }}">View tracking updates</a>
        </p>
        <p>Thank you for choosing {{ env('APP_NAME') }}.</p>
    </body>
</html>
