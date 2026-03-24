<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Booking Confirmation</title>
    </head>
    <body style="font-family: Arial, sans-serif; color: #1f2937">
        <p>Dear Customer,</p>
        <p>
            Thank you for your purchase from Travelproof NG. Your
            @if ($booking->booking_type === 'flight')
                flight reservation
            @elseif ($booking->booking_type === 'hotel')
                hotel booking
            @else
                flight reservation and hotel booking
            @endif
            will be sent as a PDF via email within 10–60 minutes during our working hours (Monday–Sunday, 10AM–6PM WAT).
            Orders placed outside these hours may take 2–8 hours to process.
        </p>
        <p>
            If you need assistance, please contact us at
            {{ config('site.support_email', 'support@travelproofng.com') }}
            or via our WhatsApp live chat.
        </p>

        <h3>Purchase Details</h3>
        <ul>
            <li>
                Item:
                @if ($booking->booking_type === 'flight')
                    Flight Ticket
                @elseif ($booking->booking_type === 'hotel')
                    Hotel Booking
                @else
                    Flight Ticket and Hotel Booking
                @endif
            </li>
            <li>Total: NGN {{ number_format($booking->total_amount, 0) }}</li>
            <li>Tracking ID: {{ $booking->tracking_id }}</li>
        </ul>

        <p>
            Track your order here:
            <a href="{{ route('track.show', $booking->tracking_id) }}">Track your booking</a>
        </p>

        <p>
            Thank you for your trust in us. We look forward to serving you.
        </p>
        <p>
            Sincerely,<br />
            Travelproof NG
        </p>
    </body>
</html>
