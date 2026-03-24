<x-layouts::app :title="__('Contact Message')">
    <div class="px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Message from {{ $contactMessage->name }}</h1>
                <p class="text-sm text-gray-600">{{ $contactMessage->created_at->format('M d, Y H:i') }}</p>
            </div>
            <a href="{{ route('admin.contact-messages.index') }}" class="inline-flex items-center px-3 py-1.5 rounded-lg bg-gray-100 text-sm text-gray-700 hover:bg-gray-200">Back</a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4 lg:col-span-2">
                <div class="text-sm text-gray-700">
                    <strong>Email:</strong> {{ $contactMessage->email }}
                </div>
                <div class="text-sm text-gray-700">
                    <strong>Phone:</strong> {{ $contactMessage->phone ?: '-' }}
                </div>
                <div class="text-sm text-gray-700">
                    <strong>Subject:</strong> {{ str_replace('-', ' ', $contactMessage->subject) }}
                </div>
                <div class="text-sm text-gray-700">
                    <strong>Message:</strong>
                    <p class="mt-2 text-gray-600">{{ $contactMessage->message }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <h2 class="text-lg font-bold text-gray-900 mb-3">Send Reply</h2>
                <form method="POST" action="{{ route('admin.contact-messages.replies.store', $contactMessage) }}" enctype="multipart/form-data" data-reply-form>
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
                        class="w-full bg-blue-600 text-white cursor-pointer py-2 rounded-lg text-sm font-semibold hover:bg-blue-700 transition disabled:opacity-70 disabled:cursor-not-allowed">
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
                @forelse ($contactMessage->replies->sortByDesc('created_at') as $reply)
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
                                            <a href="{{ route('admin.contact-messages.replies.download', [$contactMessage, $reply, $index]) }}"
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
