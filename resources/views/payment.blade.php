@extends('layouts.main')
@section('title', 'Payment')
@section('body-class', 'bg-gray-50')
@section('main-class', 'pt-24')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 pb-12">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Payment</h1>
                        <p class="text-sm text-gray-600">
                            Review your booking and select a payment method.
                        </p>
                    </div>

                    @if (session('error'))
                        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Booking Details</h2>
                    <div class="space-y-2 text-sm text-gray-700">
                        <div><strong>Tracking ID:</strong> {{ $booking->tracking_id }}</div>
                        <div><strong>Name:</strong> {{ $booking->full_name }}</div>
                        <div><strong>Email:</strong> {{ $booking->email }}</div>
                        <div><strong>Phone:</strong> {{ $booking->phone }}</div>
                        <div><strong>Type:</strong> {{ ucfirst($booking->booking_type) }}</div>
                        <div><strong>Receive:</strong> {{ $booking->receive_timing === 'later' ? 'Later' : 'Now' }}</div>
                        @if ($booking->receive_timing === 'later' && $booking->receive_date)
                            <div><strong>Delivery Date:</strong> {{ $booking->receive_date->format('M d, Y') }}</div>
                        @endif
                    </div>

                    @if ($booking->flight_details)
                        @php
                            $tripType = $booking->flight_details['trip_type'] ?? null;
                            if (!$tripType && !empty($booking->flight_details['return_date'])) {
                                $tripType = 'roundtrip';
                            }
                            $tripLabel = $tripType === 'roundtrip' ? 'Round trip' : 'One way';
                        @endphp
                        <div class="mt-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Flight Details</h3>
                            <div class="text-sm text-gray-700 space-y-1">
                                <div><span class="font-semibold text-gray-900">Trip:</span> {{ $tripLabel }}</div>
                                <div><span class="font-semibold text-gray-900">From:</span> {{ $booking->flight_details['from'] ?? '-' }}</div>
                                <div><span class="font-semibold text-gray-900">To:</span> {{ $booking->flight_details['to'] ?? '-' }}</div>
                                <div><span class="font-semibold text-gray-900">Departure:</span> {{ $booking->flight_details['departure_date'] ?? '-' }}</div>
                                @if ($tripType === 'roundtrip' && !empty($booking->flight_details['return_date']))
                                    <div><span class="font-semibold text-gray-900">Return:</span> {{ $booking->flight_details['return_date'] }}</div>
                                @endif
                                <div><span class="font-semibold text-gray-900">Passengers:</span> {{ $booking->flight_details['passengers'] ?? '-' }}</div>
                            </div>
                        </div>
                    @endif

                    @if ($booking->hotel_details)
                        <div class="mt-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Hotel Details</h3>
                            <div class="text-sm text-gray-700 space-y-1">
                                <div><span class="font-semibold text-gray-900">Destination:</span> {{ $booking->hotel_details['destination'] ?? '-' }}</div>
                                <div><span class="font-semibold text-gray-900">Check-in:</span> {{ $booking->hotel_details['check_in'] ?? '-' }}</div>
                                <div><span class="font-semibold text-gray-900">Check-out:</span> {{ $booking->hotel_details['check_out'] ?? '-' }}</div>
                                <div><span class="font-semibold text-gray-900">Guests:</span> {{ $booking->hotel_details['guests'] ?? '-' }}</div>
                            </div>
                        </div>
                    @endif

                    @if (in_array($booking->booking_type, ['flight','combo'], true) && !empty($booking->passengers))
                        <div class="mt-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Passengers</h3>
                            <div class="w-full overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50 text-gray-600">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold">#</th>
                                            <th class="px-4 py-3 text-left font-semibold">Title</th>
                                            <th class="px-4 py-3 text-left font-semibold">First Name</th>
                                            <th class="px-4 py-3 text-left font-semibold">Last Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($booking->passengers as $passenger)
                                            <tr>
                                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-3">{{ $passenger['title'] ?? '-' }}</td>
                                                <td class="px-4 py-3">{{ $passenger['first_name'] ?? ($passenger['name'] ?? '-') }}</td>
                                                <td class="px-4 py-3">{{ $passenger['last_name'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    @if (in_array($booking->booking_type, ['hotel','combo'], true) && !empty($booking->guests))
                        <div class="mt-6">
                            <h3 class="text-sm font-semibold text-gray-900 mb-2">Guests</h3>
                            <div class="w-full overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead class="bg-gray-50 text-gray-600">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-semibold">#</th>
                                            <th class="px-4 py-3 text-left font-semibold">Title</th>
                                            <th class="px-4 py-3 text-left font-semibold">First Name</th>
                                            <th class="px-4 py-3 text-left font-semibold">Last Name</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($booking->guests as $guest)
                                            <tr>
                                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                                <td class="px-4 py-3">{{ $guest['title'] ?? '-' }}</td>
                                                <td class="px-4 py-3">{{ $guest['first_name'] ?? ($guest['name'] ?? '-') }}</td>
                                                <td class="px-4 py-3">{{ $guest['last_name'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Total</h2>
                    @if ($booking->booking_type === 'combo')
                        @php
                            $tripType = $booking->flight_details['trip_type'] ?? 'oneway';
                            $tripMultiplier = $tripType === 'roundtrip' ? 1.5 : 1;
                            $base = ($booking->flight_price * ($booking->flight_details['passengers'] ?? 1) * $tripMultiplier)
                                + ($booking->hotel_price * ($booking->hotel_details['guests'] ?? 1));
                        @endphp
                        <div class="text-sm text-gray-500 line-through">
                            NGN {{ number_format($base, 0) }}
                        </div>
                    @endif
                    <div class="text-2xl font-bold text-blue-600">
                        NGN {{ number_format($booking->total_amount, 0) }}
                    </div>

                    <form method="POST" action="{{ route('payment.process', $booking->tracking_id) }}" class="mt-6 space-y-3" data-payment-form>
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
