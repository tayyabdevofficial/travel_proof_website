<x-layouts::app :title="__('Create Blog')">
    <div class="px-4 sm:px-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Create Blog</h1>
            <p class="text-sm text-gray-600">Publish a new article to the blog.</p>
        </div>

        <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data"
            class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    @include('admin.blogs.form', ['required' => true])
                </div>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image</label>
                        <input type="file" name="featured_image" accept="image/*" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-sm" />
                        @error('featured_image')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex flex-col gap-3">
                        <button type="submit" data-submit-btn
                            class="w-full rounded-lg bg-blue-600 px-6 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition disabled:opacity-70 disabled:cursor-not-allowed">
                            Save Blog
                        </button>
                        <a href="{{ route('admin.blogs.index') }}"
                            class="w-full rounded-lg border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script src="{{ asset('assets/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: '#blog-description',
                height: 520,
                menubar: false,
                plugins: 'lists link image table code',
                toolbar: 'undo redo | styles | bold italic underline | bullist numlist | link image | alignleft aligncenter alignright | code',
                branding: false,
                setup: (editor) => {
                    editor.on('change', () => editor.save());
                }
            });
        </script>
        <script>
            const titleInput = document.getElementById('blog-title');
            const slugInput = document.getElementById('blog-slug');

            const toSlug = (value) => value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)+/g, '');

            if (slugInput) {
                slugInput.addEventListener('input', () => {
                    slugInput.dataset.slugManual = slugInput.value.length > 0 ? 'true' : 'false';
                });
            }

            if (titleInput && slugInput) {
                titleInput.addEventListener('input', () => {
                    if (slugInput.dataset.slugManual === 'true') return;
                    slugInput.value = toSlug(titleInput.value);
                });
            }
        </script>
        <script>
            const createForm = document.querySelector('form[action="{{ route('admin.blogs.store') }}"]');
            if (createForm) {
                createForm.addEventListener('submit', () => {
                    const button = createForm.querySelector('[data-submit-btn]');
                    if (!button) return;
                    button.disabled = true;
                    button.innerHTML = '<span class="inline-flex items-center gap-2"><span class="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>Saving...</span>';
                });
            }
        </script>
    @endpush
</x-layouts::app>
