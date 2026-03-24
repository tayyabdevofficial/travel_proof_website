<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use App\Models\VisaConsultation;
use App\Mail\VisaConsultationPaymentConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VisaConsultationController extends Controller
{
    public function index()
    {
        $pricing = Pricing::first();
        return view('visa-consultation', compact('pricing'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'nationality' => ['required', 'string', 'max:255'],
            'destinationCountry' => ['required', 'string', 'max:255'],
            'visaType' => ['required', 'string', 'max:50'],
            'travelDate' => ['required', 'date', 'after:today'],
            'specialNote' => ['nullable', 'string', 'max:500'],
        ]);

        $pricing = Pricing::first();
        $consultationFee = (float) ($pricing->consultation_fee ?? 50000);

        $trackingId = strtoupper(Str::random(10));
        while (VisaConsultation::where('tracking_id', $trackingId)->exists()) {
            $trackingId = strtoupper(Str::random(10));
        }

        $consultation = VisaConsultation::create([
            'tracking_id' => $trackingId,
            'full_name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'nationality' => $validated['nationality'],
            'destination_country' => $validated['destinationCountry'],
            'visa_type' => $validated['visaType'],
            'travel_date' => $validated['travelDate'],
            'special_note' => $validated['specialNote'] ?? null,
            'consultation_fee' => $consultationFee,
            'payment_status' => 'pending',
        ]);

        return redirect()->route('visa.consultation.payment', $consultation->tracking_id);
    }

    public function showPayment(string $trackingId)
    {
        $consultation = VisaConsultation::where('tracking_id', $trackingId)->firstOrFail();
        if ($consultation->payment_status !== 'pending') {
            return redirect()
                ->route('visa.consultation.thankyou')
                ->with('consultation_thankyou', $consultation->tracking_id);
        }
        return view('visa-consultation-payment', compact('consultation'));
    }

    public function processPayment(Request $request, string $trackingId)
    {
        $consultation = VisaConsultation::where('tracking_id', $trackingId)->firstOrFail();
        if ($consultation->payment_status !== 'pending') {
            return redirect()
                ->route('visa.consultation.thankyou')
                ->with('consultation_thankyou', $consultation->tracking_id);
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'in:flutterwave,korapay'],
        ]);

        $provider = $validated['payment_method'];
        $currency = config("services.{$provider}.currency", 'NGN');
        $reference = 'VC-' . $consultation->tracking_id . '-' . strtoupper(Str::random(6));

        $consultation->update([
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
            $response = $http->post(rtrim(config('services.flutterwave.base_url'), '/') . '/v3/payments', [
                'tx_ref' => $reference,
                'amount' => $consultation->consultation_fee,
                'currency' => $currency,
                'redirect_url' => route('visa.consultation.flutterwave.callback', $consultation->tracking_id),
                'customer' => [
                    'email' => $consultation->email,
                    'name' => $consultation->full_name,
                    'phonenumber' => $consultation->phone,
                ],
                'customizations' => [
                    'title' => 'TravelProof Visa Consultation',
                    'description' => 'Consultation ' . $consultation->tracking_id,
                ],
                'meta' => [
                    'tracking_id' => $consultation->tracking_id,
                    'type' => 'visa-consultation',
                ],
            ]);

            if ($response->failed() || empty($response->json('data.link'))) {
                return back()->with('error', 'Unable to start Flutterwave payment. Please try again.');
            }

            return redirect()->away($response->json('data.link'));
        }

        $response = $http->post(rtrim(config('services.korapay.base_url'), '/') . '/merchant/api/v1/charges/initialize', [
            'reference' => $reference,
            'amount' => $consultation->consultation_fee,
            'currency' => $currency,
            'redirect_url' => route('visa.consultation.korapay.callback', $consultation->tracking_id),
            'customer' => [
                'name' => $consultation->full_name,
                'email' => $consultation->email,
            ],
            'metadata' => [
                'tracking_id' => $consultation->tracking_id,
                'type' => 'visa-consultation',
            ],
        ]);

        if ($response->failed() || empty($response->json('data.checkout_url'))) {
            return back()->with('error', 'Unable to start Korapay payment. Please try again.');
        }

        return redirect()->away($response->json('data.checkout_url'));
    }

    public function flutterwaveCallback(Request $request, string $trackingId)
    {
        $consultation = VisaConsultation::where('tracking_id', $trackingId)->firstOrFail();
        if ($consultation->payment_status === 'paid') {
            return redirect()
                ->route('visa.consultation.thankyou')
                ->with('consultation_thankyou', $consultation->tracking_id);
        }

        $transactionId = $request->string('transaction_id')->toString();
        if ($transactionId === '') {
            return redirect()->route('visa.consultation.payment', $consultation->tracking_id)
                ->with('error', 'Flutterwave payment could not be verified. Please try again.');
        }

        $result = $this->verifyFlutterwavePayment($transactionId, $consultation);
        if ($result['status'] === 'successful') {
            $this->markConsultationPaid($consultation, 'flutterwave', $result['reference'], $result['currency'], $result['data']);
            return redirect()
                ->route('visa.consultation.thankyou')
                ->with('consultation_thankyou', $consultation->tracking_id);
        }

        return redirect()->route('visa.consultation.payment', $consultation->tracking_id)
            ->with('error', 'Flutterwave payment was not successful. Please try again.');
    }

    public function korapayCallback(Request $request, string $trackingId)
    {
        $consultation = VisaConsultation::where('tracking_id', $trackingId)->firstOrFail();
        if ($consultation->payment_status === 'paid') {
            return redirect()
                ->route('visa.consultation.thankyou')
                ->with('consultation_thankyou', $consultation->tracking_id);
        }

        $reference = $request->string('reference')->toString();
        if ($reference === '') {
            $reference = $consultation->payment_reference ?? '';
        }

        if ($reference === '') {
            return redirect()->route('visa.consultation.payment', $consultation->tracking_id)
                ->with('error', 'Korapay payment could not be verified. Please try again.');
        }

        $result = $this->verifyKorapayPayment($reference, $consultation);
        if ($result['status'] === 'successful') {
            $this->markConsultationPaid($consultation, 'korapay', $result['reference'], $result['currency'], $result['data']);
            return redirect()
                ->route('visa.consultation.thankyou')
                ->with('consultation_thankyou', $consultation->tracking_id);
        }

        return redirect()->route('visa.consultation.payment', $consultation->tracking_id)
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

        $consultation = VisaConsultation::where('tracking_id', $trackingId)->first();
        if (!$consultation || $consultation->payment_status === 'paid') {
            return response()->json(['status' => 'ok'], 200);
        }

        $result = $this->verifyFlutterwavePayment($transactionId, $consultation);
        if ($result['status'] === 'successful') {
            $this->markConsultationPaid($consultation, 'flutterwave', $result['reference'], $result['currency'], $result['data']);
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

        $consultation = VisaConsultation::where('tracking_id', $trackingId)->first();
        if (!$consultation || $consultation->payment_status === 'paid') {
            return response()->json(['status' => 'ok'], 200);
        }

        $result = $this->verifyKorapayPayment($reference, $consultation);
        if ($result['status'] === 'successful') {
            $this->markConsultationPaid($consultation, 'korapay', $result['reference'], $result['currency'], $result['data']);
        }

        return response()->json(['status' => 'ok'], 200);
    }

    public function thankYou()
    {
        $trackingId = session('consultation_thankyou');
        if (!$trackingId) {
            return redirect()->route('home');
        }

        $consultation = VisaConsultation::where('tracking_id', $trackingId)->first();
        if (!$consultation) {
            return redirect()->route('home');
        }

        return view('visa-consultation-thankyou', compact('consultation'));
    }

    public function track(Request $request, ?string $trackingId = null)
    {
        $trackingId = $trackingId ?? $request->string('tracking')->toString();
        $consultation = null;

        if ($trackingId) {
            $consultation = VisaConsultation::where('tracking_id', $trackingId)->first();
            if ($consultation) {
                $consultation->load('replies');
            }
        }

        return view('visa-consultation-track', [
            'trackingId' => $trackingId,
            'consultation' => $consultation,
        ]);
    }

    public function downloadReplyAttachment(Request $request, string $trackingId, $replyId, int $index)
    {
        $consultation = VisaConsultation::where('tracking_id', $trackingId)->firstOrFail();
        $reply = $consultation->replies()->findOrFail($replyId);

        $file = ($reply->attachments ?? [])[$index] ?? null;
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

    private function verifyFlutterwavePayment(string $transactionId, VisaConsultation $consultation): array
    {
        $http = Http::withToken(config('services.flutterwave.secret_key'))->acceptJson();
        if (config('services.payments.disable_ssl_verify')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->get(rtrim(config('services.flutterwave.base_url'), '/') . '/v3/transactions/' . $transactionId . '/verify');

        $data = $response->json('data') ?? [];
        $status = $data['status'] ?? '';
        $reference = $data['tx_ref'] ?? $consultation->payment_reference ?? '';
        $currency = $data['currency'] ?? config('services.flutterwave.currency', 'NGN');

        $amountOk = isset($data['amount']) && (float) $data['amount'] >= (float) $consultation->consultation_fee;
        $referenceOk = $reference !== '' && $reference === ($consultation->payment_reference ?? $reference);

        if (!$response->ok() || $status !== 'successful' || !$amountOk || !$referenceOk) {
            return ['status' => 'failed', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
        }

        return ['status' => 'successful', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
    }

    private function verifyKorapayPayment(string $reference, VisaConsultation $consultation): array
    {
        $http = Http::withToken(config('services.korapay.secret_key'))->acceptJson();
        if (config('services.payments.disable_ssl_verify')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->get(rtrim(config('services.korapay.base_url'), '/') . '/merchant/api/v1/charges/' . $reference);

        $data = $response->json('data') ?? [];
        $status = $data['status'] ?? '';
        $currency = $data['currency'] ?? config('services.korapay.currency', 'NGN');
        $amountOk = isset($data['amount']) && (float) $data['amount'] >= (float) $consultation->consultation_fee;
        $referenceOk = $consultation->payment_reference ? $consultation->payment_reference === $reference : true;

        if (!$response->ok() || $status !== 'success' || !$amountOk || !$referenceOk) {
            return ['status' => 'failed', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
        }

        return ['status' => 'successful', 'reference' => $reference, 'currency' => $currency, 'data' => $data];
    }

    private function markConsultationPaid(VisaConsultation $consultation, string $provider, string $reference, string $currency, array $meta): void
    {
        if ($consultation->payment_status === 'paid') {
            return;
        }

        $consultation->update([
            'payment_method' => $provider,
            'payment_provider' => $provider,
            'payment_reference' => $reference,
            'payment_currency' => $currency,
            'payment_meta' => $meta,
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);

        Mail::to($consultation->email)->send(new VisaConsultationPaymentConfirmation($consultation));
    }
}
