<x-layouts::app :title="__('Contact Messages')">
    <div class="px-4 sm:px-6">
        <div class="mb-4">
            <h1 class="text-2xl font-bold text-gray-900">Contact Messages</h1>
            <p class="text-sm text-gray-600">Messages sent from the contact page.</p>
        </div>
        <div class="mb-6">
            <form class="flex flex-wrap gap-2" method="GET" action="{{ route('admin.contact-messages.index') }}">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Search name, email, subject"
                    class="w-64 px-3 py-2 border border-gray-300 rounded-lg text-sm"
                />
                <select name="subject" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                    <option value="">All Subjects</option>
                    @foreach (['booking-inquiry','payment-issue','document-verification','technical-support','general-question','other'] as $subject)
                        <option value="{{ $subject }}" @selected(request('subject') === $subject)>
                            {{ Str::ucfirst(str_replace('-', ' ', $subject)) }}
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
                <a href="{{ route('admin.contact-messages.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50">Clear</a>
            </form>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="w-full overflow-x-auto">
                <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Name</th>
                        <th class="px-4 py-3 text-left font-semibold">Email</th>
                        <th class="px-4 py-3 text-left font-semibold">Subject</th>
                        <th class="px-4 py-3 text-left font-semibold">Date</th>
                        <th class="px-4 py-3 text-right font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($messages as $message)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-gray-900">{{ $message->name }}</td>
                            <td class="px-4 py-3">{{ $message->email }}</td>
                            <td class="px-4 py-3 capitalize">{{ str_replace('-', ' ', $message->subject) }}</td>
                            <td class="px-4 py-3 text-xs text-gray-500">{{ $message->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.contact-messages.show', $message) }}" class="inline-flex items-center rounded-lg bg-blue-50 px-3 py-1 text-blue-700 hover:bg-blue-100 font-semibold text-sm">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500">No messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    </div>
</x-layouts::app>
