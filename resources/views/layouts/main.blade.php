<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Flight & Hotel Reservations')</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Geist:wght@600&display=swap">
        <script src="https://cdn.jsdelivr.net/npm/posthog-js@1.96.1/dist/array.full.min.js" async=""></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .icon-theme-blue {
                filter: brightness(0) saturate(100%) invert(37%) sepia(97%) saturate(1720%) hue-rotate(201deg) brightness(96%) contrast(92%);
            }
            [data-tab-trigger].text-gray-600 .icon-theme-blue {
                filter: brightness(0) saturate(100%) invert(55%) sepia(10%) saturate(439%) hue-rotate(182deg) brightness(93%) contrast(88%);
            }
        </style>
        @stack('head')
    </head>
    <body class="@yield('body-class', '')" data-default-tab="@yield('default-tab')">
        <div class="min-h-screen flex flex-col">
            @include('partials.site-header')
            <main class="flex-grow @yield('main-class', '')">
                @hasSection('page-hero-title')
                    <section class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-12">
                        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                            @hasSection('page-hero-icon')
                                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 [&>img]:brightness-0 [&>img]:invert">
                                    @yield('page-hero-icon')
                                </div>
                            @endif
                            <h1 class="text-3xl md:text-4xl font-bold mb-3">@yield('page-hero-title')</h1>
                            @hasSection('page-hero-subtitle')
                                <p class="text-lg text-blue-100">
                                    @yield('page-hero-subtitle')
                                </p>
                            @endif
                        </div>
                    </section>
                @endif
                @yield('content')
            </main>
            @include('partials.site-footer')
        </div>
        <a href="{{ config('site.whatsapp') }}"
           target="_blank"
           rel="noopener noreferrer"
           class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-green-500 hover:bg-green-600 text-white flex items-center justify-center shadow-lg transition-all"
           aria-label="WhatsApp Support">
            <img src="/images/icons/whatsapp.svg" alt="WhatsApp" class="w-6 h-6 brightness-0 invert">
        </a>
        @stack('scripts')
    </body>
</html>
