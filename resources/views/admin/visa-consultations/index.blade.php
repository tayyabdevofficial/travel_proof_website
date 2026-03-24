<x-layouts::app :title="__('Visa Consultations')">
    <div class="px-4 sm:px-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900">Visa Consultations</h1>
            <p class="text-sm text-gray-600">Requests submitted from the consultation page.</p>
        </div>
        <div class="mb-6">
            <form class="flex flex-wrap gap-2" method="GET" action="{{ route('admin.visa-consultations.index') }}">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search name, email, destination"
                    class="w-64 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                />
                <select name="visa_type" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">All Visa Types</option>
                    @foreach (['tourist','student','work','business','transit','other'] as $type)
                        <option value="{{ $type }}" @selected(request('visa_type') === $type)>
                            {{ ucfirst($type) }}
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
                    <option value="latest" @selected(request('sort') === 'latest')>Newest</option>
                    <option value="oldest" @selected(request('sort') === 'oldest')>Oldest</option>
                </select>
                <button class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm">Filter</button>
                <a href="{{ route('admin.visa-consultations.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Clear</a>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Email</th>
                        <th class="px-4 py-3 text-left font-semibold">Destination</th>
                        <th class="px-4 py-3 text-left font-semibold">Visa Type</th>
                        <th class="px-4 py-3 text-left font-semibold">Payment</th>
                        <th class="px-4 py-3 text-left font-semibold">Amount</th>
                        <th class="px-4 py-3 text-left font-semibold">Date</th>
                        <th class="px-4 py-3 text-right font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($consultations as $consultation)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $consultation->full_name }}</td>
                            <td class="px-4 py-3">{{ $consultation->email }}</td>
                            <td class="px-4 py-3">{{ $consultation->destination_country }}</td>
                            <td class="px-4 py-3 capitalize">{{ $consultation->visa_type }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $consultation->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($consultation->payment_status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">NGN {{ number_format($consultation->consultation_fee ?? 0, 0) }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">{{ $consultation->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.visa-consultations.show', $consultation) }}" class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-1 text-blue-700 hover:bg-blue-100 font-semibold text-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-6 text-center text-gray-500">No consultations yet.</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $consultations->links() }}
        </div>
    </div>
</x-layouts::app>
