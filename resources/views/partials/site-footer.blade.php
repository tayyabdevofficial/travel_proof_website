<footer id="contact" class="bg-gradient-to-br from-blue-600 to-blue-700 text-white py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div>
                <h3 class="text-base font-bold mb-3">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('blogs.index') }}">Blogs</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('how.it.works') }}">How It Works</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('sample') }}">Sample</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('about') }}">About Us</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-base font-bold mb-3">Services</h3>
                <ul class="space-y-2 text-sm">
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('flight.booking') }}">Flight Reservation</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('hotel.booking') }}">Hotel Confirmation</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('combo.booking') }}">Flight + Hotel Package</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('visa.consultation') }}">Visa Consultation</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-base font-bold mb-3">Support</h3>
                <ul class="space-y-2 text-sm">
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('track.index') }}">Track Booking</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('visa.consultation.track') }}">Track Consultation</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('contact') }}">Contact Us</a></li>
                    <li><a class="hover:text-blue-200 transition-colors cursor-pointer" href="{{ route('faq') }}">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-base font-bold mb-3">Contact</h3>
                <ul class="space-y-2 text-sm mb-4">
                    <li class="flex items-start gap-2">
                        <div class="w-4 h-4 flex items-center justify-center mt-0.5">
                            <img src="/images/icons/mail.svg" alt="" class="w-4 h-4 brightness-0 invert">
                        </div>
                        <span>{{ config('site.email') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <div class="w-4 h-4 flex items-center justify-center mt-0.5">
                            <img src="/images/icons/phone.svg" alt="" class="w-4 h-4 brightness-0 invert">
                        </div>
                        <span>{{ config('site.phone') }}</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <div class="w-4 h-4 flex items-center justify-center mt-0.5">
                            <img src="/images/icons/clock.svg" alt="" class="w-4 h-4 brightness-0 invert">
                        </div>
                        <span>Monday – Sunday,<br> 10:00 AM – 6:00 PM (WAT)</span>
                    </li>
                </ul>
                <div class="flex items-center gap-3">
                    <a href="{{ config('site.socials.facebook') }}" target="_blank" rel="noopener noreferrer"
                       class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors cursor-pointer">
                        <img src="/images/icons/facebook.svg" alt="Facebook" class="w-4 h-4 brightness-0 invert">
                    </a>
                    <a href="{{ config('site.socials.instagram') }}" target="_blank" rel="noopener noreferrer"
                       class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors cursor-pointer">
                        <img src="/images/icons/instagram.svg" alt="Instagram" class="w-4 h-4 brightness-0 invert">
                    </a>
                    <a href="{{ config('site.socials.twitter') }}" target="_blank" rel="noopener noreferrer"
                       class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors cursor-pointer">
                        <img src="/images/icons/twitter.svg" alt="Twitter" class="w-4 h-4 brightness-0 invert">
                    </a>
                    <a href="{{ config('site.whatsapp') }}" target="_blank" rel="noopener noreferrer"
                       class="w-8 h-8 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-colors cursor-pointer">
                        <img src="/images/icons/whatsapp.svg" alt="WhatsApp" class="w-4 h-4 brightness-0 invert">
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
            <img src="{{ asset('images/brands/dmca-protected.png') }}" alt="DMCA Protected" class="h-8 w-auto">
            <img src="{{ asset('images/brands/iata.png') }}" alt="IATA" class="h-8 w-auto brightness-0 invert">
            <img src="{{ asset('images/brands/ssl-secure.png') }}" alt="Secure SSL" class="h-8 w-auto">
        </div>
        <div class="border-t border-blue-500 pt-4 mt-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-3 text-sm">
                <div class="text-blue-100 text-center md:text-left">
                    <div>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.
                    <span class="text-xs text-blue-200 mt-1">Powered by Styletrips Limited</span>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-blue-100">
                    <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </div>
</footer>
