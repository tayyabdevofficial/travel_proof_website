@props([
    'blog' => null,
    'required' => false,
])

<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
        <input type="text" name="title" id="blog-title" @if ($required) required @endif
            value="{{ old('title', $blog->title ?? '') }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm" />
        @error('title')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
        <input type="text" name="slug" id="blog-slug" data-slug-manual="false"
            value="{{ old('slug', $blog->slug ?? '') }}"
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
            placeholder="auto-generated if left blank" />
        @error('slug')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
        <textarea name="short_description" rows="3" @if ($required) required @endif
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none">{{ old('short_description', $blog->short_description ?? '') }}</textarea>
        @error('short_description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea id="blog-description" name="description" @if ($required) required @endif
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">{{ old('description', $blog->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

</div>
