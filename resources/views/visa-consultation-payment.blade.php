@extends('layouts.main')
@section('title', 'Consultation Payment')
@section('body-class', 'bg-gray-50')
@section('main-class', 'pt-24')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 pb-12">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Consultation Payment</h1>
            <p class="text-sm text-gray-600">
                Review your consultation details and complete payment.
            </p>
        </div>

        @if (session('error'))
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Consultation Details</h2>
                <div class="space-y-2 text-sm text-gray-700">
                    <div><strong>Tracking ID:</strong> {{ $consultation->tracking_id }}</div>
                    <div><strong>Name:</strong> {{ $consultation->full_name }}</div>
                    <div><strong>Email:</strong> {{ $consultation->email }}</div>
                    <div><strong>Phone:</strong> {{ $consultation->phone }}</div>
                    <div><strong>Nationality:</strong> {{ $consultation->nationality }}</div>
                    <div><strong>Destination:</strong> {{ $consultation->destination_country }}</div>
                    <div><strong>Visa Type:</strong> {{ ucfirst($consultation->visa_type) }}</div>
                    <div><strong>Travel Date:</strong> {{ $consultation->travel_date->format('M d, Y') }}</div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Total</h2>
                <div class="text-2xl font-bold text-blue-600">
                    NGN {{ number_format($consultation->consultation_fee, 0) }}
                </div>

                <form method="POST" action="{{ route('visa.consultation.payment.process', $consultation->tracking_id) }}" class="mt-6 space-y-3" data-payment-form>
                    @csrf
                    <label class="block text-sm font-medium text-gray-700">Select Payment Method</label>
                    <input type="hidden" name="payment_method" value="" data-payment-method />
                    <div class="space-y-3">
                        <button type="button" class="w-full border border-blue-100 rounded-xl p-5 flex items-center justify-center hover:border-blue-400 hover:bg-blue-50 transition-colors cursor-pointer" data-payment-card data-method="korapay">
                            <img src="{{ asset('images/brands/korapay.svg') }}" alt="Korapay" class="h-10 w-auto block" />
                        </button>
                        <button type="button" class="w-full border border-blue-100 rounded-xl p-5 flex items-center justify-center hover:border-blue-400 hover:bg-blue-50 transition-colors cursor-pointer" data-payment-card data-method="flutterwave">
                            <img src="{{ asset('images/brands/flutterwave.png') }}" alt="Flutterwave" class="h-10 w-auto block" />
                        </button>
                    </div>
                    @error('payment_method')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    <button
                        type="submit"
                        class="w-full mt-4 bg-blue-600 cursor-pointer text-white py-3 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-colors disabled:opacity-70 disabled:cursor-not-allowed"
                        data-payment-submit
                    >
                        Continue to Payment
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('[data-payment-form]');
            const methodInput = document.querySelector('[data-payment-method]');
            const cards = document.querySelectorAll('[data-payment-card]');
            const submitBtn = document.querySelector('[data-payment-submit]');
            const errorEl = document.createElement('p');
            errorEl.className = 'text-xs text-red-500 mt-2 hidden';
            errorEl.textContent = 'Please select a payment method.';
            form.appendChild(errorEl);
            if (!form || !methodInput || !cards.length) return;

            const setActive = (card) => {
                cards.forEach((c) => c.classList.remove('border-blue-600', 'bg-blue-50'));
                card.classList.add('border-blue-600', 'bg-blue-50');
            };

            cards.forEach((card) => {
                card.addEventListener('click', () => {
                    const method = card.dataset.method || '';
                    if (!method) return;
                    methodInput.value = method;
                    setActive(card);
                    errorEl.classList.add('hidden');
                });
            });

            form.addEventListener('submit', (event) => {
                if (!methodInput.value) {
                    event.preventDefault();
                    errorEl.classList.remove('hidden');
                    return;
                }
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Redirecting...';
                }
            });
        });
    </script>
@endsection
