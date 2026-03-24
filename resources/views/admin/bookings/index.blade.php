<x-layouts::app :title="__('Bookings')">
    <div class="px-4 sm:px-6">
        <div class="mb-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Bookings</h1>
                <p class="text-sm text-gray-600">Manage flight and hotel reservation requests.</p>
            </div>
        </div>
        <div class="mb-6">
            <form class="flex flex-wrap gap-2" method="GET" action="{{ route('admin.bookings.index') }}">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search tracking, name, email"
                    class="w-64 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                />
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">All Status</option>
                    @foreach (['pending','processing','rejected','refunded','completed'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                <select name="preset" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">Preset Range</option>
                    <option value="last7" @selected(request('preset') === 'last7')>Last 7 Days</option>
                    <option value="thismonth" @selected(request('preset') === 'thismonth')>This Month</option>
                </select>
                <input
                    type="date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm"
                />
                <input
                    type="date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                    class="px-3 py-2 border border-gray-300 rounded-lg text-sm"
                />
                <select name="sort" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="latest" @selected(request('sort', 'latest') === 'latest')>Newest</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                </select>
                <button class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm">Filter</button>
                <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Clear</a>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Tracking ID</th>
                        <th class="px-4 py-3 text-left font-semibold">Customer</th>
                        <th class="px-4 py-3 text-left font-semibold">Type</th>
                        <th class="px-4 py-3 text-left font-semibold">Status</th>
                        <th class="px-4 py-3 text-left font-semibold">Payment</th>
                        <th class="px-4 py-3 text-left font-semibold">Total</th>
                        <th class="px-4 py-3 text-left font-semibold">Created</th>
                        <th class="px-4 py-3 text-right font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-900">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="text-blue-700 hover:text-blue-900">
                                    {{ $booking->tracking_id }}
                                </a>
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-900">{{ $booking->full_name }}</div>
                                <div class="text-xs text-gray-500">{{ $booking->email }}</div>
                            </td>
                            <td class="px-4 py-3 capitalize">{{ $booking->booking_type }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClasses = match($booking->status) {
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'refunded' => 'bg-purple-100 text-purple-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
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
                            </td>
                            <td class="px-4 py-3">NGN {{ number_format($booking->total_amount, 0) }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">{{ $booking->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.bookings.show', $booking) }}" class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-1 text-blue-700 hover:bg-blue-100 font-semibold text-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>
    </div>
</x-layouts::app>
