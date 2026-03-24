<x-layouts::app :title="__('Blogs')">
    <div class="px-4 sm:px-6">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Blogs
                </h1>
                <p class="text-sm text-gray-600">
                    Create and manage blog posts shown on the website.
                </p>
            </div>
            <a href="{{ route('admin.blogs.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700 transition">
                Add New Blog
            </a>
        </div>
        <form method="GET" class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center gap-3">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Search by title, slug, or summary"
                    class="w-full md:max-w-md px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700 transition">
                        Search
                    </button>
                    <a href="{{ route('admin.blogs.index') }}"
                        class="rounded-lg border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                        Clear
                    </a>
                </div>
            </div>
        </form>

        @if (session('status'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Title</th>
                            <th class="px-4 py-3 font-semibold">Slug</th>
                            <th class="px-4 py-3 font-semibold">Created</th>
                            <th class="px-4 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($blogs as $blog)
                            <tr>
                                <td class="px-4 py-3 text-gray-900 font-semibold">
                                    {{ $blog->title }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $blog->slug }}
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $blog->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('blogs.show', $blog->slug) }}" target="_blank"
                                            class="rounded-lg border border-gray-200 px-3 py-1.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                                            View
                                        </a>
                                        <a href="{{ route('admin.blogs.edit', $blog) }}"
                                            class="rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}"
                                            onsubmit="return confirm('Delete this blog?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-4 py-6 text-center text-gray-500" colspan="4">
                                    No blogs yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    </div>
</x-layouts::app>
