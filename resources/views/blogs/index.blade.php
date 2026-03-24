@extends('layouts.main')
@section('title', 'Blogs')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-icon')
    <img alt="Blogs" class="h-10 w-10" src="{{ asset('images/icons/document.svg') }}" />
@endsection
@section('page-hero-title', 'Latest Blogs')
@section('page-hero-subtitle', 'Insights, tips, and updates for visa-ready travel')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($blogs as $blog)
                    <article class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-xl transition-all">
                        <a href="{{ route('blogs.show', $blog->slug) }}" class="block">
                            <img
                                src="{{ $blog->featured_image ? Storage::url($blog->featured_image) : asset('images/sample-flight.jpg') }}"
                                alt="{{ $blog->title }}"
                                class="h-48 w-full object-cover"
                            />
                        </a>
                        <div class="p-5">
                            <div class="text-xs text-gray-500 mb-2">
                                {{ $blog->created_at->format('M d, Y') }}
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="hover:text-blue-600 transition-colors">
                                    {{ $blog->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mb-4">
                                {{ $blog->short_description }}
                            </p>
                            <a href="{{ route('blogs.show', $blog->slug) }}"
                                class="inline-flex items-center gap-2 text-blue-600 font-semibold text-sm hover:text-blue-700 transition-colors">
                                Read More
                                <img alt="Arrow" class="h-4 w-4" src="{{ asset('images/icons/arrow-right.svg') }}" />
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center text-gray-500">
                        No blog posts yet.
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
@endsection
