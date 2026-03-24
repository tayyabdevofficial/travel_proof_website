<nav id="site-nav" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-transparent">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a class="flex items-center gap-2 cursor-pointer" href="{{ url('/') }}">
                <img alt="Logo" class="h-10 w-auto object-contain" src="{{ asset('logo.png') }}" />
            </a>
            <div class="hidden md:flex items-center gap-6">
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('flight.booking') }}">Flights</a>
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('hotel.booking') }}">Hotels</a>
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('sample') }}">Sample</a>
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('how.it.works') }}">How It Works</a>
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('track.index') }}">Track Booking</a>
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('contact') }}">Contact Us</a>
                <a class="transition-colors text-sm font-medium cursor-pointer text-gray-900 hover:text-blue-600"
                   href="{{ route('about') }}">About Us</a>
            </div>
            <button class="md:hidden cursor-pointer text-gray-900" type="button" data-nav-toggle>
                <img src="/images/icons/menu.svg" alt="Menu" class="w-7 h-7" data-nav-icon data-icon-open="/images/icons/close.svg" data-icon-closed="/images/icons/menu.svg">
            </button>
        </div>
    </div>
    <div class="md:hidden border-t border-gray-200 bg-white/95 backdrop-blur fixed top-16 left-0 right-0 z-40 transform -translate-y-4 opacity-0 pointer-events-none transition-all duration-300 max-h-[calc(100vh-4rem)] overflow-y-auto" data-nav-menu>
        <div class="px-4 py-4 space-y-3 text-sm">
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('flight.booking') }}">Flights</a>
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('hotel.booking') }}">Hotels</a>
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('sample') }}">Sample</a>
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('how.it.works') }}">How It Works</a>
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('track.index') }}">Track Booking</a>
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('contact') }}">Contact Us</a>
            <a class="block text-gray-900 hover:text-blue-600" href="{{ route('about') }}">About Us</a>
        </div>
    </div>
</nav>
