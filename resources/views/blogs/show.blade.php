@extends('layouts.main')
@section('title', $blog->title)
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <div class="text-left mb-10">
                        <p class="text-sm text-gray-500 mb-3">{{ $blog->created_at->format('M d, Y') }}</p>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                            {{ $blog->title }}
                        </h1>
                        @if ($blog->short_description)
                            <p class="mt-4 text-base text-gray-600">
                                {{ $blog->short_description }}
                            </p>
                        @endif
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-gray-200 shadow-lg mb-10">
                        <img
                            src="{{ $blog->featured_image ? Storage::url($blog->featured_image) : asset('images/sample-hotel.jpg') }}"
                            alt="{{ $blog->title }}"
                            class="w-full h-72 md:h-96 object-cover"
                        />
                    </div>

                    <div class="prose prose-blue max-w-none">
                        {!! $blog->description !!}
                    </div>
                </div>
                <aside class="lg:col-span-1">
                    <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Recent Blogs</h2>
                        <div class="space-y-4">
                            @forelse ($recentBlogs as $recent)
                                <a href="{{ route('blogs.show', $recent->slug) }}" class="flex gap-3 group">
                                    <img
                                        src="{{ $recent->featured_image ? Storage::url($recent->featured_image) : asset('images/sample-flight.jpg') }}"
                                        alt="{{ $recent->title }}"
                                        class="h-16 w-20 object-cover rounded-lg border border-gray-200 flex-shrink-0"
                                    />
                                    <div>
                                        <div class="text-xs text-gray-500 mb-1">
                                            {{ $recent->created_at->format('M d, Y') }}
                                        </div>
                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                                            {{ $recent->title }}
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">No recent blogs yet.</p>
                            @endforelse
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
