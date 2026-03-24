<x-layouts::app :title="__('Visa Consultation')">
    <div class="px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Consultation: {{ $visaConsultation->full_name }}</h1>
                <p class="text-sm text-gray-600">{{ $visaConsultation->created_at->format('M d, Y H:i') }}</p>
            </div>
            <a href="{{ route('admin.visa-consultations.index') }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 text-sm text-gray-700 hover:bg-gray-200">Back</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4 text-sm text-gray-700 lg:col-span-2">
                <div><strong>Email:</strong> {{ $visaConsultation->email }}</div>
                <div><strong>Phone:</strong> {{ $visaConsultation->phone }}</div>
                <div><strong>Nationality:</strong> {{ $visaConsultation->nationality }}</div>
                <div><strong>Destination:</strong> {{ $visaConsultation->destination_country }}</div>
                <div><strong>Visa Type:</strong> {{ ucfirst($visaConsultation->visa_type) }}</div>
                <div><strong>Travel Date:</strong> {{ $visaConsultation->travel_date->format('M d, Y') }}</div>
                <div class="flex flex-wrap items-center gap-2">
                    <strong>Payment Status:</strong>
                    @php
                        $paymentClasses = match($visaConsultation->payment_status) {
                            'paid' => 'bg-green-100 text-green-800',
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            default => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $paymentClasses }}">
                        {{ ucfirst($visaConsultation->payment_status) }}
                    </span>
                </div>
                <div><strong>Payment Provider:</strong> {{ strtoupper($visaConsultation->payment_provider ?? $visaConsultation->payment_method ?? '-') }}</div>
                <div><strong>Payment Reference:</strong> {{ $visaConsultation->payment_reference ?? '-' }}</div>
                <div><strong>Payment Currency:</strong> {{ $visaConsultation->payment_currency ?? 'NGN' }}</div>
                <div><strong>Amount:</strong> NGN {{ number_format($visaConsultation->consultation_fee ?? 0, 0) }}</div>
                @if ($visaConsultation->paid_at)
                    <div><strong>Paid At:</strong> {{ $visaConsultation->paid_at->format('M d, Y H:i') }}</div>
                @endif
                <div>
                    <strong>Special Note:</strong>
                    <p class="mt-2 text-gray-600">{{ $visaConsultation->special_note ?: '-' }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <h2 class="text-lg font-bold text-gray-900 mb-3">Send Reply</h2>
                <form method="POST" action="{{ route('admin.visa-consultations.replies.store', $visaConsultation) }}" enctype="multipart/form-data" data-reply-form>
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Reply Message</label>
                        <textarea name="message" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"></textarea>
                        @error('message')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Attachments (optional)</label>
                        <input type="file" name="attachments[]" multiple
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-sm" />
                        @error('attachments.*')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" data-submit-btn
                        class="w-full bg-blue-600 text-white py-2 cursor-pointer rounded-lg text-sm font-semibold hover:bg-blue-700 transition disabled:opacity-70 disabled:cursor-not-allowed">
                        Send Reply
                    </button>
                </form>
            </div>
        </div>

        @if (session('status'))
            <div class="mt-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-6 space-y-4">
            <div class="space-y-4">
                <h2 class="text-lg font-bold text-gray-900">Replies</h2>
                @forelse ($visaConsultation->replies->sortByDesc('created_at') as $reply)
                    <div class="bg-white rounded-xl border border-gray-200 p-4">
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                            <span>{{ $reply->created_at->format('M d, Y H:i') }}</span>
                            <span>By {{ $reply->admin_id ? 'Admin' : 'System' }}</span>
                        </div>
                        <p class="text-sm text-gray-700 whitespace-pre-line">{{ $reply->message }}</p>
                        @if (!empty($reply->attachments))
                            <div class="mt-3 text-sm">
                                <div class="font-semibold text-gray-700 mb-1">Attachments</div>
                                <ul class="list-disc list-inside text-blue-600">
                                    @foreach ($reply->attachments as $index => $file)
                                        <li>
                                            <a href="{{ route('admin.visa-consultations.replies.download', [$visaConsultation, $reply, $index]) }}"
                                                class="hover:text-blue-700">
                                                {{ $file['name'] ?? 'Attachment' }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-sm text-gray-500">No replies yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const replyForm = document.querySelector('[data-reply-form]');
            if (replyForm) {
                replyForm.addEventListener('submit', () => {
                    const button = replyForm.querySelector('[data-submit-btn]');
                    if (!button) return;
                    button.disabled = true;
                    button.innerHTML = '<span class="inline-flex items-center gap-2"><span class="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>Sending...</span>';
                });
            }
        </script>
    @endpush
</x-layouts::app>
