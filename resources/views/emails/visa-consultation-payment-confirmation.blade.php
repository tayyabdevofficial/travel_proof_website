<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Consultation Payment Confirmation</title>
    </head>
    <body style="font-family: Arial, sans-serif; color: #1f2937">
        <h2>Visa Consultation Payment Confirmed</h2>
        <p>
            Thank you. Your consultation payment has been received successfully.
        </p>
        <p>
            Tracking ID: <strong>{{ $consultation->tracking_id }}</strong>
        </p>
        <h3>Summary</h3>
        <ul>
            <li>Name: {{ $consultation->full_name }}</li>
            <li>Email: {{ $consultation->email }}</li>
            <li>Phone: {{ $consultation->phone }}</li>
            <li>Nationality: {{ $consultation->nationality }}</li>
            <li>Destination: {{ $consultation->destination_country }}</li>
            <li>Visa Type: {{ ucfirst($consultation->visa_type) }}</li>
            <li>Travel Date: {{ $consultation->travel_date->format('M d, Y') }}</li>
            <li>Amount: NGN {{ number_format($consultation->consultation_fee, 0) }}</li>
            <li>Payment Method: {{ strtoupper($consultation->payment_provider ?? $consultation->payment_method ?? '-') }}</li>
            @if ($consultation->payment_reference)
                <li>Payment Reference: {{ $consultation->payment_reference }}</li>
            @endif
            <li>Payment Status: {{ ucfirst($consultation->payment_status) }}</li>
        </ul>
        @if ($consultation->special_note)
            <p>Special Note:</p>
            <div style="margin:0 0 12px; padding:12px; border:1px solid #e5e7eb; border-radius:8px; font-family: Arial, sans-serif;">
                {!! nl2br(e($consultation->special_note)) !!}
            </div>
        @endif
        <p>
            You can track your consultation using the link below:
        </p>
        <p>
            <a href="{{ route('visa.consultation.track.show', $consultation->tracking_id) }}">Track your consultation</a>
        </p>
    </body>
</html>
