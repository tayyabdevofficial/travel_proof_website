<x-layouts::app :title="__('Booking Details')">
    <div class="px-4 sm:px-6">
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Booking {{ $booking->tracking_id }}</h1>
                <p class="text-sm text-gray-600">Status: <span class="capitalize">{{ $booking->status }}</span></p>
            </div>
            <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 text-sm text-gray-700 hover:bg-gray-200">Back to Bookings</a>
        </div>

        @if (session('status'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Customer Details</h2>
                    <div class="space-y-2 text-sm text-gray-700">
                        <div><strong>Name:</strong> {{ $booking->full_name }}</div>
                        <div><strong>Email:</strong> {{ $booking->email }}</div>
                        <div><strong>Phone:</strong> {{ $booking->phone }}</div>
                        <div><strong>Booking Type:</strong> {{ ucfirst($booking->booking_type) }}</div>
                        <div class="flex flex-wrap items-center gap-2">
                            <strong>Payment Status:</strong>
                            @php
                                $paymentClasses = match($booking->payment_status) {
                                    'paid' => 'bg-green-100 text-green-800',
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $paymentClasses }}">
                                {{ ucfirst($booking->payment_status) }}
                            </span>
                        </div>
                        @if ($booking->payment_status === 'paid')
                            <div><strong>Payment Provider:</strong> {{ strtoupper($booking->payment_provider ?? $booking->payment_method ?? '-') }}</div>
                            <div><strong>Payment Reference:</strong> {{ $booking->payment_reference ?? '-' }}</div>
                            <div><strong>Payment Currency:</strong> {{ $booking->payment_currency ?? 'NGN' }}</div>
                            @if ($booking->paid_at)
                                <div><strong>Paid At:</strong> {{ $booking->paid_at->format('M d, Y H:i') }}</div>
                            @endif
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

                @if ($booking->receive_timing === 'later' && $booking->receive_date)
                    <div class="bg-white rounded-xl border border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Delivery Date</h2>
                        <div class="text-sm text-gray-700">
                            {{ $booking->receive_date->format('M d, Y') }}
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
                                                    <a href="{{ route('admin.bookings.updates.download', [$booking, $update, $index]) }}" target="_blank">
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
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Add Update</h2>
                    <form method="POST" action="{{ route('admin.bookings.updates.store', $booking) }}" enctype="multipart/form-data" class="space-y-4" data-admin-update-form>
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" required>
                                @foreach (['pending','processing','rejected','refunded','completed'] as $status)
                                    <option value="{{ $status }}" @selected($booking->status === $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Update Note</label>
                            <textarea name="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm" placeholder="Optional update for the customer"></textarea>
                            @error('message')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Attachments (optional)</label>
                            <div class="rounded-lg border border-gray-300 bg-gray-50 px-3 py-2 hover:bg-gray-100 transition-colors">
                                <input type="file" name="attachments[]" multiple class="w-full text-sm bg-transparent" />
                            </div>
                            @error('attachments.*')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full cursor-pointer bg-blue-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 disabled:opacity-70 disabled:cursor-not-allowed" data-admin-update-submit>
                            Send Update
                        </button>
                    </form>
                </div>

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
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('[data-admin-update-form]');
            const submitBtn = document.querySelector('[data-admin-update-submit]');
            if (!form || !submitBtn) return;
            form.addEventListener('submit', () => {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Sending...';
            });
        });
    </script>
</x-layouts::app>
