@extends('layouts.main')

@section('title', 'Track Booking')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-icon')
                <img src="/images/icons/search.svg" alt="" class="w-10 h-10">
@endsection
@section('page-hero-title', 'Track Your Booking')
@section('page-hero-subtitle', "Enter your tracking ID to view booking details and updates")

@section('content')
    <section class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 md:p-8 mb-8">
                <form method="GET" action="{{ route('track.index') }}" class="flex flex-col md:flex-row gap-4 md:items-end">
                    <div class="flex-1 w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tracking ID</label>
                        <input
                            type="text"
                            name="tracking"
                            value="{{ $trackingId }}"
                            placeholder="Enter your tracking ID"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                            required
                        />
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-blue-600 cursor-pointer text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors whitespace-nowrap">
                        Track Booking
                    </button>
                </form>
            </div>

            @if ($trackingId && !$booking)
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 mb-6">
                    No booking found for tracking ID <strong>{{ $trackingId }}</strong>.
                </div>
            @endif

            @if ($booking)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Booking Details</h2>
                            <div class="space-y-2 text-sm text-gray-700">
                                <div><strong>Tracking ID:</strong> {{ $booking->tracking_id }}</div>
                                <div><strong>Name:</strong> {{ $booking->full_name }}</div>
                                <div><strong>Email:</strong> {{ $booking->email }}</div>
                                <div><strong>Phone:</strong> {{ $booking->phone }}</div>
                                <div><strong>Booking Type:</strong> {{ ucfirst($booking->booking_type) }}</div>
                                <div><strong>Status:</strong> <span class="capitalize">{{ $booking->status }}</span></div>
                                <div><strong>Payment:</strong> {{ ucfirst($booking->payment_status) }} ({{ strtoupper($booking->payment_provider ?? $booking->payment_method ?? '-') }})</div>
                                <div><strong>Receive:</strong> {{ $booking->receive_timing === 'later' ? 'Later' : 'Now' }}</div>
                                @if ($booking->receive_timing === 'later' && $booking->receive_date)
                                    <div><strong>Delivery Date:</strong> {{ $booking->receive_date->format('M d, Y') }}</div>
                                @endif
                            </div>
                        </div>

                        @if ($booking->flight_details)
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Flight Details</h2>
                                <div class="space-y-1 text-sm text-gray-700">
                                    <div><span class="font-semibold text-gray-900">From:</span> {{ $booking->flight_details['from'] ?? '-' }}</div>
                                    <div><span class="font-semibold text-gray-900">To:</span> {{ $booking->flight_details['to'] ?? '-' }}</div>
                                    <div><span class="font-semibold text-gray-900">Departure:</span> {{ $booking->flight_details['departure_date'] ?? '-' }}</div>
                                    @if (!empty($booking->flight_details['return_date']))
                                        <div><span class="font-semibold text-gray-900">Return:</span> {{ $booking->flight_details['return_date'] }}</div>
                                    @endif
                                    <div><span class="font-semibold text-gray-900">Passengers:</span> {{ $booking->flight_details['passengers'] ?? '-' }}</div>
                                </div>
                            </div>
                        @endif

                        @if ($booking->hotel_details)
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Hotel Details</h2>
                                <div class="space-y-1 text-sm text-gray-700">
                                    <div><span class="font-semibold text-gray-900">Destination:</span> {{ $booking->hotel_details['destination'] ?? '-' }}</div>
                                    <div><span class="font-semibold text-gray-900">Check-in:</span> {{ $booking->hotel_details['check_in'] ?? '-' }}</div>
                                    <div><span class="font-semibold text-gray-900">Check-out:</span> {{ $booking->hotel_details['check_out'] ?? '-' }}</div>
                                    <div><span class="font-semibold text-gray-900">Guests:</span> {{ $booking->hotel_details['guests'] ?? '-' }}</div>
                                </div>
                            </div>
                        @endif

                        @if (in_array($booking->booking_type, ['flight','combo'], true) && !empty($booking->passengers))
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Passengers</h2>
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
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Guests</h2>
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

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Updates</h2>
                            <div class="space-y-4">
                                @forelse ($booking->updates->sortByDesc('created_at') as $update)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between text-sm">
                                            <div class="font-semibold text-gray-900 capitalize">{{ $update->status ?? $booking->status }}</div>
                                            <div class="text-gray-500">{{ $update->created_at->format('M d, Y H:i') }}</div>
                                        </div>
                                        @if ($update->message)
                                            <p class="mt-2 text-sm text-gray-700">{{ $update->message }}</p>
                                        @endif
                                        @if (!empty($update->attachments))
                                            <div class="mt-3 text-sm">
                                                <div class="font-semibold text-gray-700 mb-1">Attachments</div>
                                                <ul class="list-disc list-inside text-blue-600">
                                                    @foreach ($update->attachments as $index => $file)
                                                        <li>
                                                            <a href="{{ route('track.updates.download', [$booking->tracking_id, $update, $index]) }}">
                                                                {{ $file['name'] ?? 'Attachment' }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No updates yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Totals</h2>
                            <div class="text-sm text-gray-700 space-y-2">
                                @if (in_array($booking->booking_type, ['flight','combo'], true))
                                    <div>Flight Price: NGN {{ number_format($booking->flight_price ?? 0, 0) }}</div>
                                @endif
                                @if (in_array($booking->booking_type, ['hotel','combo'], true))
                                    <div>Hotel Price: NGN {{ number_format($booking->hotel_price ?? 0, 0) }}</div>
                                @endif
                                @if ($booking->booking_type === 'combo')
                                    <div>Discount: {{ number_format($booking->discount_percent ?? 0, 3) }}%</div>
                                @endif
                                <div class="font-semibold text-gray-900">Total: NGN {{ number_format($booking->total_amount, 0) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
