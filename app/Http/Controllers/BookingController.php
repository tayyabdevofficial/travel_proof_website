<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmation;
use App\Mail\BookingAdminNotification;
use App\Models\Booking;
use App\Models\BookingUpdate;
use App\Models\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $type = $request->input('reservationType', 'flight');
        if (!in_array($type, ['flight', 'hotel', 'combo'], true)) {
            $type = 'flight';
        }

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'from' => ['nullable', 'string', 'max:255'],
            'to' => ['nullable', 'string', 'max:255'],
            'fromCode' => ['nullable', 'string', 'max:10'],
            'toCode' => ['nullable', 'string', 'max:10'],
            'departureDate' => ['nullable', 'date', 'after:today'],
            'returnDate' => ['nullable', 'date', 'after:departureDate'],
            'passengers_count' => ['nullable', 'integer', 'min:1', 'max:6'],
            'passengers.*.title' => ['nullable', 'string', 'max:50'],
            'passengers.*.first_name' => ['nullable', 'string', 'max:255'],
            'passengers.*.last_name' => ['nullable', 'string', 'max:255'],
            'hotelCheckIn' => ['nullable', 'date'],
            'hotelCheckOut' => ['nullable', 'date'],
            'hotelDestination' => ['nullable', 'string', 'max:255'],
            'guests_count' => ['nullable', 'integer', 'min:1', 'max:6'],
            'guests.*.title' => ['nullable', 'string', 'max:50'],
            'guests.*.first_name' => ['nullable', 'string', 'max:255'],
            'guests.*.last_name' => ['nullable', 'string', 'max:255'],
            'specialNote' => ['nullable', 'string', 'max:1000'],
            'receive_timing' => ['required', 'in:now,later'],
            'receive_date' => ['nullable', 'date'],
            'trip_type' => ['nullable', 'in:oneway,roundtrip'],
        ]);

        $validator->after(function ($validator) use ($request, $type) {
            if (in_array($type, ['flight', 'combo'], true)) {
                if (!$request->filled('from') || !$request->filled('to')) {
                    $validator->errors()->add('from', 'Departure and arrival are required.');
                }
                if (!$request->filled('departureDate')) {
                    $validator->errors()->add('departureDate', 'Departure date is required.');
                }
                if ($request->input('trip_type') === 'roundtrip' && !$request->filled('returnDate')) {
                    $validator->errors()->add('returnDate', 'Return date is required for round trip.');
                }
            }

            if (in_array($type, ['hotel', 'combo'], true)) {
                if (!$request->filled('hotelDestination')) {
                    $validator->errors()->add('hotelDestination', 'Destination is required.');
                }
                if (!$request->filled('hotelCheckIn')) {
                    $validator->errors()->add('hotelCheckIn', 'Check-in date is required.');
                }
                if (!$request->filled('hotelCheckOut')) {
                    $validator->errors()->add('hotelCheckOut', 'Check-out date is required.');
                }
            }

            $passengersCount = (int) ($request->input('passengers_count') ?? 1);
            $guestsCount = (int) ($request->input('guests_count') ?? 1);

            if (in_array($type, ['flight', 'combo'], true)) {
                $passengers = $request->input('passengers', []);
                for ($i = 1; $i <= $passengersCount; $i++) {
                    $row = $passengers[$i] ?? $passengers[$i - 1] ?? null;
                    if (!$row || empty($row['title']) || empty($row['first_name']) || empty($row['last_name'])) {
                        $validator->errors()->add('passengers', "Passenger {$i} information is required.");
                    }
                }
            }

            if (in_array($type, ['hotel', 'combo'], true)) {
                $guests = $request->input('guests', []);
                for ($i = 1; $i <= $guestsCount; $i++) {
                    $row = $guests[$i] ?? $guests[$i - 1] ?? null;
                    if (!$row || empty($row['title']) || empty($row['first_name']) || empty($row['last_name'])) {
                        $validator->errors()->add('guests', "Guest {$i} information is required.");
                    }
                }
            }

            if ($request->input('receive_timing') === 'later' && !$request->filled('receive_date')) {
                $validator->errors()->add('receive_date', 'Delivery date is required when selecting receive later.');
            }
        });

        $validated = $validator->validate();

        $pricing = Pricing::first();
        $flightPrice = (float) ($pricing->flight_price ?? 5000);
        $hotelPrice = (float) ($pricing->hotel_price ?? 4000);
        $discountPercent = (float) ($pricing->combo_discount_percent ?? 0);

        $passengersCount = (int) ($validated['passengers_count'] ?? 1);
        $guestsCount = (int) ($validated['guests_count'] ?? 1);

        $tripMultiplier = ($validated['trip_type'] ?? 'oneway') === 'roundtrip' ? 1.5 : 1;
        $total = 0;
        if ($type === 'flight') {
            $total = $flightPrice * $passengersCount * $tripMultiplier;
        } elseif ($type === 'hotel') {
            $total = $hotelPrice * $guestsCount;
        } else {
            $base = ($flightPrice * $passengersCount * $tripMultiplier) + ($hotelPrice * $guestsCount);
            $total = $base * (1 - $discountPercent / 100);
        }

        $trackingId = strtoupper(Str::random(10));
        while (Booking::where('tracking_id', $trackingId)->exists()) {
            $trackingId = strtoupper(Str::random(10));
        }

        $passengerRows = $request->input('passengers', []);
        $guestRows = $request->input('guests', []);
        $primary = null;
        if (in_array($type, ['flight', 'combo'], true)) {
            $primary = $passengerRows[1] ?? $passengerRows[0] ?? null;
        }
        if (!$primary && in_array($type, ['hotel', 'combo'], true)) {
            $primary = $guestRows[1] ?? $guestRows[0] ?? null;
        }
        $fullName = trim(($primary['first_name'] ?? '') . ' ' . ($primary['last_name'] ?? ''));
        if ($fullName === '') {
            $fullName = 'Guest';
        }

        $booking = Booking::create([
            'tracking_id' => $trackingId,
            'booking_type' => $type,
            'full_name' => $fullName,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'flight_details' => $type !== 'hotel' ? [
                'from' => $validated['from'] ?? null,
                'to' => $validated['to'] ?? null,
                'from_code' => $validated['fromCode'] ?? null,
                'to_code' => $validated['toCode'] ?? null,
                'departure_date' => $validated['departureDate'] ?? null,
                'return_date' => $validated['returnDate'] ?? null,
                'trip_type' => $validated['trip_type'] ?? 'oneway',
                'passengers' => $passengersCount,
            ] : null,
            'hotel_details' => $type !== 'flight' ? [
                'destination' => $validated['hotelDestination'] ?? null,
                'check_in' => $validated['hotelCheckIn'] ?? null,
                'check_out' => $validated['hotelCheckOut'] ?? null,
                'guests' => $guestsCount,
            ] : null,
            'passengers' => $passengerRows,
            'guests' => $guestRows,
            'special_note' => $validated['specialNote'] ?? null,
            'receive_timing' => $validated['receive_timing'],
            'receive_date' => $validated['receive_date'] ?? null,
            'flight_price' => $type === 'hotel' ? null : $flightPrice,
            'hotel_price' => $type === 'flight' ? null : $hotelPrice,
            'discount_percent' => $type === 'combo' ? $discountPercent : 0,
            'total_amount' => $total,
            'payment_status' => 'pending',
        ]);

        return redirect()->route('payment.show', $booking->tracking_id);
    }

    public function showPayment(string $trackingId)
    {
        $booking = Booking::where('tracking_id', $trackingId)->firstOrFail();
        if ($booking->payment_status !== 'pending') {
            return redirect()->route('home');
        }
        return view('payment', compact('booking'));
    }

    public function processPayment(Request $request, string $trackingId)
    {
        $booking = Booking::where('tracking_id', $trackingId)->firstOrFail();
        if ($booking->payment_status !== 'pending') {
            return redirect()->route('home');
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'in:flutterwave,korapay'],
        ]);

        $provider = $validated['payment_method'];
        $currency = config("services.{$provider}.currency", 'NGN');
        $reference = 'TP-' . $booking->tracking_id . '-' . strtoupper(Str::random(6));

        $booking->update([
            'payment_method' => $provider,
            'payment_provider' => $provider,
            'payment_reference' => $reference,
            'payment_currency' => $currency,
        ]);

        $http = Http::withToken(config("services.{$provider}.secret_key"))->acceptJson();
        if (config('services.payments.disable_ssl_verify')) {
            $http = $http->withoutVerifying();
        }

        if ($provider === 'flutterwave') {
            $response = $http
                ->acceptJson()
                ->post(rtrim(config('services.flutterwave.base_url'), '/') . '/v3/payments', [
                    'tx_ref' => $reference,
                    'amount' => $booking->total_amount,
                    'currency' => $currency,
                    'redirect_url' => route('payment.flutterwave.callback', $booking->tracking_id),
                    'customer' => [
                        'email' => $booking->email,
                        'name' => $booking->full_name,
                        'phonenumber' => $booking->phone,
                    ],
                    'customizations' => [
                        'title' => 'TravelProof Payment',
                        'description' => 'Booking ' . $booking->tracking_id,
                    ],
                    'meta' => [
                        'tracking_id' => $booking->tracking_id,
                        'booking_type' => $booking->booking_type,
                    ],
                ]);

            if ($response->failed() || empty($response->json('data.link'))) {
                return back()->with('error', 'Unable to start Flutterwave payment. Please try again.');
            }

            return redirect()->away($response->json('data.link'));
        }

        $response = $http
            ->post(rtrim(config('services.korapay.base_url'), '/') . '/merchant/api/v1/charges/initialize', [
                'reference' => $reference,
                'amount' => $booking->total_amount,
                'currency' => $currency,
                'redirect_url' => route('payment.korapay.callback', $booking->tracking_id),
                'customer' => [
                    'name' => $booking->full_name,
                    'email' => $booking->email,
                ],
                'metadata' => [
                    'tracking_id' => $booking->tracking_id,
                    'booking_type' => $booking->booking_type,
                ],
            ]);

        if ($response->failed() || empty($response->json('data.checkout_url'))) {
            return back()->with('error', 'Unable to start Korapay payment. Please try again.');
        }

        return redirect()->away($response->json('data.checkout_url'));
    }

    public function thankYou()
    {
        $trackingId = session('booking_thankyou');
        if (!$trackingId) {
            return redirect()->route('home');
        }

        $booking = Booking::where('tracking_id', $trackingId)->first();
        if (!$booking) {
            return redirect()->route('home');
        }

        return view('thanks', compact('booking'));
    }

    public function flutterwaveCallback(Request $request, string $trackingId)
    {
        $booking = Booking::where('tracking_id', $trackingId)->firstOrFail();
        if ($booking->payment_status === 'paid') {
            return redirect()
                ->route('payment.thankyou')
                ->with('booking_thankyou', $booking->tracking_id);
        }

        $transactionId = $request->string('transaction_id')->toString();
        if ($transactionId === '') {
            return redirect()->route('payment.show', $booking->tracking_id)
                ->with('error', 'Flutterwave payment could not be verified. Please try again.');
        }

        $result = $this->verifyFlutterwavePayment($transactionId, $booking);
        if ($result['status'] === 'successful') {
            $this->markBookingPaid($booking, 'flutterwave', $result['reference'], $result['currency'], $result['data']);
            return redirect()
                ->route('payment.thankyou')
                ->with('booking_thankyou', $booking->tracking_id);
        }

        return redirect()->route('payment.show', $booking->tracking_id)
            ->with('error', 'Flutterwave payment was not successful. Please try again.');
    }

    public function korapayCallback(Request $request, string $trackingId)
    {
        $booking = Booking::where('tracking_id', $trackingId)->firstOrFail();
        if ($booking->payment_status === 'paid') {
            return redirect()
                ->route('payment.thankyou')
                ->with('booking_thankyou', $booking->tracking_id);
        }

        $reference = $request->string('reference')->toString();
        if ($reference === '') {
            $reference = $booking->payment_reference ?? '';
        }

        if ($reference === '') {
            return redirect()->route('payment.show', $booking->tracking_id)
                ->with('error', 'Korapay payment could not be verified. Please try again.');
        }

        $result = $this->verifyKorapayPayment($reference, $booking);
        if ($result['status'] === 'successful') {
            $this->markBookingPaid($booking, 'korapay', $result['reference'], $result['currency'], $result['data']);
            return redirect()
                ->route('payment.thankyou')
                ->with('booking_thankyou', $booking->tracking_id);
        }

        return redirect()->route('payment.show', $booking->tracking_id)
            ->with('error', 'Korapay payment was not successful. Please try again.');
    }

    public function flutterwaveWebhook(Request $request)
    {
        $secret = config('services.flutterwave.webhook_secret');
        $signature = $request->header('verif-hash');
        if (!$secret || !$signature || !hash_equals($secret, $signature)) {
            return response()->json(['status' => 'invalid'], 400);
        }

        $payload = $request->all();
        $data = $payload['data'] ?? [];
        $transactionId = $data['id'] ?? null;
        $trackingId = $data['meta']['tracking_id'] ?? null;

        if (!$transactionId || !$trackingId) {
            return response()->json(['status' => 'ignored'], 200);
        }

        $booking = Booking::where('tracking_id', $trackingId)->first();
        if (!$booking || $booking->payment_status === 'paid') {
            return response()->json(['status' => 'ok'], 200);
        }

        $result = $this->verifyFlutterwavePayment($transactionId, $booking);
        if ($result['status'] === 'successful') {
            $this->markBookingPaid($booking, 'flutterwave', $result['reference'], $result['currency'], $result['data']);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function korapayWebhook(Request $request)
    {
        $secret = config('services.korapay.webhook_secret');
        $signature = $request->header('x-korapay-signature');
        $computed = $secret ? hash_hmac('sha256', $request->getContent(), $secret) : null;
        if (!$secret || !$signature || !hash_equals($computed, $signature)) {
            return response()->json(['status' => 'invalid'], 400);
        }

        $payload = $request->all();
        $data = $payload['data'] ?? [];
        $reference = $data['reference'] ?? null;
        $trackingId = $data['metadata']['tracking_id'] ?? null;

        if (!$reference || !$trackingId) {
            return response()->json(['status' => 'ignored'], 200);
        }

        $booking = Booking::where('tracking_id', $trackingId)->first();
        if (!$booking || $booking->payment_status === 'paid') {
            return response()->json(['status' => 'ok'], 200);
        }

        $result = $this->verifyKorapayPayment($reference, $booking);
        if ($result['status'] === 'successful') {
            $this->markBookingPaid($booking, 'korapay', $result['reference'], $result['currency'], $result['data']);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function track(Request $request, ?string $trackingId = null)
    {
        $trackingId = $trackingId ?? $request->string('tracking')->toString();
        $booking = null;

        if ($trackingId) {
            $booking = Booking::where('tracking_id', $trackingId)->first();
            if ($booking) {
                $booking->load('updates');
            }
        }

        return view('track', [
            'trackingId' => $trackingId,
            'booking' => $booking,
        ]);
    }

    public function downloadUpdateAttachment(Request $request, string $trackingId, BookingUpdate $update, int $index)
    {
        $booking = Booking::where('tracking_id', $trackingId)->firstOrFail();
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

    private function verifyFlutterwavePayment(string $transactionId, Booking $booking): array
    {
        $http = Http::withToken(config('services.flutterwave.secret_key'))->acceptJson();
        if (config('services.payments.disable_ssl_verify')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->get(rtrim(config('services.flutterwave.base_url'), '/') . '/v3/transactions/' . $transactionId . '/verify');

        $data = $response->json('data') ?? [];
        $status = $data['status'] ?? '';
        $reference = $data['tx_ref'] ?? $booking->payment_reference ?? '';
        $currency = $data['currency'] ?? config('services.flutterwave.currency', 'NGN');

        $amountOk = isset($data['amount']) && (float) $data['amount'] >= (float) $booking->total_amount;
        $referenceOk = $reference !== '' && $reference === ($booking->payment_reference ?? $reference);

        if (!$response->ok() || $status !== 'successful' || !$amountOk || !$referenceOk) {
            return ['status' => 'failed', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
        }

        return ['status' => 'successful', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
    }

    private function verifyKorapayPayment(string $reference, Booking $booking): array
    {
        $http = Http::withToken(config('services.korapay.secret_key'))->acceptJson();
        if (config('services.payments.disable_ssl_verify')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->get(rtrim(config('services.korapay.base_url'), '/') . '/merchant/api/v1/charges/' . $reference);

        $data = $response->json('data') ?? [];
        $status = $data['status'] ?? '';
        $currency = $data['currency'] ?? config('services.korapay.currency', 'NGN');
        $amountOk = isset($data['amount']) && (float) $data['amount'] >= (float) $booking->total_amount;
        $referenceOk = $booking->payment_reference ? $booking->payment_reference === $reference : true;

        if (!$response->ok() || $status !== 'success' || !$amountOk || !$referenceOk) {
            return ['status' => 'failed', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
        }

        return ['status' => 'successful', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
    }

    private function markBookingPaid(Booking $booking, string $provider, string $reference, string $currency, array $meta): void
    {
        if ($booking->payment_status === 'paid') {
            return;
        }

        $booking->update([
            'payment_method' => $provider,
            'payment_provider' => $provider,
            'payment_reference' => $reference,
            'payment_currency' => $currency,
            'payment_meta' => $meta,
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        Mail::to($booking->email)->send(new BookingConfirmation($booking));
        Mail::to(config('site.support_email', 'support@travelproofng.com'))
            ->send(new BookingAdminNotification($booking));
    }
}
