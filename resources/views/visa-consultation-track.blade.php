@extends('layouts.main')

@section('title', 'Track Consultation')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-icon')
    <img src="/images/icons/search.svg" alt="" class="w-10 h-10">
@endsection
@section('page-hero-title', 'Track Your Consultation')
@section('page-hero-subtitle', 'Enter your tracking ID to view consultation details and updates')

@section('content')
    <section class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-6 md:p-8 mb-8">
                <form method="GET" action="{{ route('visa.consultation.track') }}" class="flex flex-col md:flex-row gap-4 md:items-end">
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
                        Track Consultation
                    </button>
                </form>
            </div>

            @if ($trackingId && !$consultation)
                <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 mb-6">
                    No consultation found for tracking ID <strong>{{ $trackingId }}</strong>.
                </div>
            @endif

            @if ($consultation)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
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
                                <div><strong>Payment:</strong> {{ ucfirst($consultation->payment_status) }} ({{ strtoupper($consultation->payment_provider ?? $consultation->payment_method ?? '-') }})</div>
                                <div><strong>Amount:</strong> NGN {{ number_format($consultation->consultation_fee ?? 0, 0) }}</div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Replies</h2>
                            <div class="space-y-4">
                                @forelse ($consultation->replies->sortByDesc('created_at') as $reply)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-center justify-between text-sm">
                                            <div class="font-semibold text-gray-900">Update</div>
                                            <div class="text-gray-500">{{ $reply->created_at->format('M d, Y H:i') }}</div>
                                        </div>
                                        @if ($reply->message)
                                            <p class="mt-2 text-sm text-gray-700">{{ $reply->message }}</p>
                                        @endif
                                        @if (!empty($reply->attachments))
                                            <div class="mt-3 text-sm">
                                                <div class="font-semibold text-gray-700 mb-1">Attachments</div>
                                                <ul class="list-disc list-inside text-blue-600">
                                                    @foreach ($reply->attachments as $index => $file)
                                                        <li>
                                                            <a href="{{ route('visa.consultation.replies.download', [$consultation->tracking_id, $reply->id, $index]) }}" target="_blank">
                                                                {{ $file['name'] ?? 'Attachment' }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No replies yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-xl border border-gray-200 p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Payment Summary</h2>
                            <div class="text-sm text-gray-700 space-y-2">
                                <div>Amount: NGN {{ number_format($consultation->consultation_fee ?? 0, 0) }}</div>
                                <div>Status: {{ ucfirst($consultation->payment_status) }}</div>
                                <div>Provider: {{ strtoupper($consultation->payment_provider ?? $consultation->payment_method ?? '-') }}</div>
                                <div>Reference: {{ $consultation->payment_reference ?? '-' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
