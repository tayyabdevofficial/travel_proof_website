@extends('layouts.main')
@section('title', 'Flight & Hotel Reservations')

@section('content')
    @php
        $flightPrice = (float) ($pricing->flight_price ?? 5000);
        $hotelPrice = (float) ($pricing->hotel_price ?? 4000);
        $discountPercent = (float) ($pricing->combo_discount_percent ?? 0);
        $comboBase = $flightPrice + $hotelPrice;
        $comboPrice = $comboBase * (1 - $discountPercent / 100);
        $comboSavings = $comboBase - $comboPrice;
    @endphp
    <div id="root">

        <section class="relative overflow-hidden bg-white">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-blue-100 blur-3xl opacity-70"></div>
                <div class="absolute -bottom-24 -left-24 h-72 w-72 rounded-full bg-blue-50 blur-3xl opacity-70"></div>
            </div>
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                    <div class="text-left">
                        <div class="flex flex-wrap items-center gap-3 mb-6">
                            <div class="flex items-center gap-2 bg-white border border-gray-200 rounded-full px-3 py-1 shadow-sm text-[10px] sm:text-xs">
                                <img alt="Google" class="h-4 w-auto sm:h-5" src="{{ asset('images/icons/google-g.svg') }}" />
                                <div class="flex items-center gap-0.5 text-yellow-400">
                                    <img alt="Star" class="h-3 w-3 sm:h-4 sm:w-4" src="{{ asset('images/icons/star.svg') }}" />
                                    <img alt="Star" class="h-3 w-3 sm:h-4 sm:w-4" src="{{ asset('images/icons/star.svg') }}" />
                                    <img alt="Star" class="h-3 w-3 sm:h-4 sm:w-4" src="{{ asset('images/icons/star.svg') }}" />
                                    <img alt="Star" class="h-3 w-3 sm:h-4 sm:w-4" src="{{ asset('images/icons/star.svg') }}" />
                                    <img alt="Star" class="h-3 w-3 sm:h-4 sm:w-4" src="{{ asset('images/icons/star.svg') }}" />
                                </div>
                                <span class="font-semibold text-gray-700">Rated 5.0 | Trusted by 25,000+ Nigerian Travelers</span>
                            </div>
                        </div>
                        <h1 class="text-4xl md:text-3xl xl:text-4xl font-bold text-gray-900 leading-tight mb-5">
                            Verified Flight & Hotel Reservations For
                            <span class="text-blue-600">Visa Applications</span>
                        </h1>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6 max-w-xl">
                            Get embassy-accepted flight reservations and hotel confirmations for visa applicants worldwide. Every booking includes a real, <b>verifiable PNR code</b>, verifiable on the airline’s website, and valid for up to <b>14 days</b>.
                        </p>
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mb-6">
                            <button type="button" data-scroll-target="#booking-form" data-tab-target="flight"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-all hover:scale-105 shadow-lg whitespace-nowrap cursor-pointer">
                                <img alt="Flight" class="h-5 w-5" src="{{ asset('images/icons/airplane-white.svg') }}" />Get Flight Reservation</button>
                            <button type="button" data-scroll-target="#booking-form" data-tab-target="hotel"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold text-sm hover:bg-blue-50 transition-all hover:scale-105 shadow-lg border border-blue-600 whitespace-nowrap cursor-pointer">
                                <img alt="Hotel" class="h-5 w-5" src="{{ asset('images/icons/hotel-blue.svg') }}" />Get Hotel Reservation
                            </button>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -top-6 -left-6 bg-white/90 border border-gray-200 rounded-2xl px-4 py-3 shadow-lg hidden md:flex items-center gap-3 z-20">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                                <img alt="Verified" class="h-5 w-5" src="{{ asset('images/icons/check-badge.svg') }}" />
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Embassy Accepted</div>
                                <div class="text-xs text-gray-500">Worldwide verification</div>
                            </div>
                        </div>
                        <div class="absolute -bottom-6 -right-6 bg-white/90 border border-gray-200 rounded-2xl px-4 py-3 shadow-lg hidden md:flex items-center gap-3 z-20">
                            <div class="w-10 h-10 bg-blue-50 rounded-full flex items-center justify-center">
                                <img alt="Fast" class="h-5 w-5" src="{{ asset('images/icons/clock.svg') }}" />
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">Fast Delivery</div>
                                <div class="text-xs text-gray-500">Within 30 minutes</div>
                            </div>
                        </div>
                        <div class="relative z-10 bg-gradient-to-br from-blue-50 to-white p-3 rounded-3xl shadow-2xl border border-blue-100">
                            <img
                                alt="Verified travel reservation support"
                                class="w-full h-full object-cover rounded-2xl"
                                src="{{ asset('images/hero_image.png') }}"
                            />
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex flex-wrap items-center justify-center gap-3 text-[10px] sm:text-sm text-gray-700">
                    <div class="flex items-center gap-2 bg-blue-50 px-2 py-2 sm:px-4 sm:py-2.5 rounded-full border border-blue-200">
                        <img alt="Fast" class="h-4 w-4 sm:h-5 sm:w-5" src="{{ asset('images/icons/clock.svg') }}" /><span class="font-semibold">30-Min Delivery</span>
                    </div>
                    <div class="flex items-center gap-2 bg-blue-50 px-2 py-2 sm:px-4 sm:py-2.5 rounded-full border border-blue-200">
                        <img alt="Support" class="h-4 w-4 sm:h-5 sm:w-5" src="{{ asset('images/icons/chat.svg') }}" /><span class="font-semibold">24/7 Support</span>
                    </div>
                    <div class="flex items-center gap-2 bg-blue-50 px-2 py-2 sm:px-4 sm:py-2.5 rounded-full border border-blue-200">
                        <img alt="Verified" class="h-4 w-4 sm:h-5 sm:w-5" src="{{ asset('images/icons/shield-check.svg') }}" /><span class="font-semibold">Embassy Verified</span>
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="text-center text-xs font-semibold text-gray-600 mb-4 uppercase tracking-wide">Trusted By Major Organizations</h3>
                    <div class="brand-marquee">
                        <div class="brand-track">
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_1.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_2.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_3.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_4.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_5.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_6.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_7.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_8.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_9.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_10.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_11.avif') }}" />
                            <img alt="IATA" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/iata.svg') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_1.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_2.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_3.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_4.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_5.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_6.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_7.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_8.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_9.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_10.avif') }}" />
                            <img alt="Brand" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/fli_11.avif') }}" />
                            <img alt="IATA" class="h-8 sm:h-15 w-auto object-contain opacity-80 hover:opacity-100" src="{{ asset('images/brands/iata.svg') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="booking-form" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                @include('partials.forms.booking-form', ['showTabs' => true, 'activeTab' => 'flight', 'comboSavings' => $comboSavings])
            </div>
        </section>
        <section id="how-it-works" class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                        How It Works
                    </h2>
                    <p class="text-base text-gray-600">
                        Get your documents in three simple steps
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="relative bg-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all group">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full font-bold text-lg flex-shrink-0 shadow-lg">
                                1
                            </div>
                            <div class="flex-1">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 rounded-lg mb-3">
                                    <img alt="Form" class="h-6 w-6" src="{{ asset('images/icons/document.svg') }}" />
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    Fill Simple Form
                                </h3>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Enter your travel details and
                                    passenger information in our
                                    secure form. Takes less than 2
                                    minutes.
                                </p>
                            </div>
                            <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                                <div class="w-6 h-6 flex items-center justify-center bg-blue-600 rounded-full shadow-lg">
                                    <img alt="Next" class="h-4 w-4 brightness-0 invert" src="{{ asset('images/icons/arrow-right.svg') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative bg-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all group">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full font-bold text-lg flex-shrink-0 shadow-lg">
                                2
                            </div>
                            <div class="flex-1">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 rounded-lg mb-3">
                                    <img alt="Payment" class="h-6 w-6" src="{{ asset('images/icons/currency.svg') }}" />
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    Make Payment
                                </h3>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Secure payment via bank
                                    transfer, card, or mobile money.
                                    All transactions are encrypted
                                    and protected.
                                </p>
                            </div>
                            <div class="hidden md:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                                <div class="w-6 h-6 flex items-center justify-center bg-blue-600 rounded-full shadow-lg">
                                    <img alt="Next" class="h-4 w-4 brightness-0 invert" src="{{ asset('images/icons/arrow-right.svg') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative bg-gray-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all group">
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full font-bold text-lg flex-shrink-0 shadow-lg">
                                3
                            </div>
                            <div class="flex-1">
                                <div class="w-10 h-10 flex items-center justify-center bg-blue-100 rounded-lg mb-3">
                                    <img alt="Delivery" class="h-6 w-6 icon-theme-blue" src="{{ asset('images/icons/arrow-right.svg') }}" />
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    Fast PDF Delivery
                                </h3>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    Get your embassy-ready flight
                                    reservation and hotel booking
                                    documents delivered to your
                                    email within minutes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="benefits" class="py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                        Why Choose Our Service?
                    </h2>
                    <p class="text-base text-gray-600">
                        We provide reliable, fast, and embassy and
                        immigration approved documents for your visa
                        application needs.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-200">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mb-4">
                            <img alt="Fast" class="h-7 w-7" src="{{ asset('images/icons/clock.svg') }}" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            Fast Delivery
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Reservations sent within 30-60 minutes
                            during working hours and up to 6 hours
                            during the peak hours.
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-200">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mb-4">
                            <img alt="Verified" class="h-7 w-7" src="{{ asset('images/icons/shield-check.svg') }}" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            Embassy Verified
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            All documents are accepted by embassies
                            worldwide and meet official
                            requirements.
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-200">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mb-4">
                            <img alt="Support" class="h-7 w-7" src="{{ asset('images/icons/chat.svg') }}" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            24/7 Support
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Our dedicated team is available round
                            the clock to assist you via WhatsApp and
                            email.
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-200">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mb-4">
                            <img alt="PNR" class="h-7 w-7" src="{{ asset('images/icons/check-badge.svg') }}" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            Real PNR Code
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Every reservation includes a genuine PNR
                            code that can be verified on airline
                            websites.
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-200">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mb-4">
                            <img alt="Onward" class="h-7 w-7" src="{{ asset('images/icons/airplane-blue.svg') }}" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            Proof of Onward Travel
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Valid proof of onward travel
                            documentation accepted by immigration
                            authorities worldwide.
                        </p>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-200">
                        <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg mb-4">
                            <img alt="Pricing" class="h-7 w-7" src="{{ asset('images/icons/currency.svg') }}" />
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">
                            Affordable Pricing
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Get professional visa documents at
                            competitive prices with no hidden fees.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-16 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                        Travelproof tickets are perfect for...
                    </h2>
                    <p class="text-base text-gray-600">
                        When you might need our service
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-8 border border-blue-200 hover:shadow-xl transition-all">
                        <div class="w-14 h-14 flex items-center justify-center bg-blue-100 rounded-xl mb-4">
                            <img alt="Passport" class="h-8 w-8" src="{{ asset('images/icons/passport.svg') }}" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            Visa applications
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Travelproof help travelers prove travel
                            intent for visa approvals without buying
                            real flights.
                        </p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-8 border border-blue-200 hover:shadow-xl transition-all">
                        <div class="w-14 h-14 flex items-center justify-center bg-blue-100 rounded-xl mb-4">
                            <img alt="Map" class="h-8 w-8" src="{{ asset('images/icons/map-pin.svg') }}" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            Border entry requirements
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Many countries require proof of travel,
                            onward tickets solve this without
                            financial commitment.
                        </p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-8 border border-blue-200 hover:shadow-xl transition-all">
                        <div class="w-14 h-14 flex items-center justify-center bg-blue-100 rounded-xl mb-4">
                            <img alt="Travel" class="h-8 w-8" src="{{ asset('images/icons/briefcase.svg') }}" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            Frequent travelers
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Frequent travelers use onward tickets to
                            stay flexible without booking costly
                            return flights upfront.
                        </p>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-8 border border-blue-200 hover:shadow-xl transition-all">
                        <div class="w-14 h-14 flex items-center justify-center bg-blue-100 rounded-xl mb-4">
                            <img alt="Global" class="h-8 w-8" src="{{ asset('images/icons/globe.svg') }}" />
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            Digital nomad visa
                        </h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Onward tickets support digital nomads in
                            meeting visa rules while keeping travel
                            plans open-ended.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section id="pricing" class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-2">
                        Pricing
                    </h2>
                    <p class="text-sm text-gray-600">
                        Choose the package that fits your needs
                    </p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div
                        class="bg-white rounded-2xl p-7 border border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <img alt="Flight" class="h-6 w-6" src="{{ asset('images/icons/airplane-white.svg') }}" />
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    Flight Reservation
                                </h3>
                                <div class="text-xl font-bold text-blue-600">
                                    NGN {{ number_format($flightPrice, 0) }}<span
                                        class="text-sm text-gray-500 font-normal">/person</span>
                                </div>
                            </div>
                        </div>
                        <ul class="space-y-2 mb-5">
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Flight Reservation PDF</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Embassy Accepted Format</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Verifiable PNR Code</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>10 – 60 minutes (during our opening hours)</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Valid For up to 2 Weeks</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>24/7 Support</span>
                            </li>
                        </ul>
                        <button type="button" data-scroll-target="#booking-form" data-tab-target="flight"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-all whitespace-nowrap cursor-pointer">
                            Book Now
                        </button>
                    </div>
                    <div
                        class="bg-white rounded-2xl p-7 border border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <img alt="Hotel" class="h-6 w-6 brightness-0 invert" src="{{ asset('images/icons/hotel.svg') }}" />
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    Hotel Confirmation
                                </h3>
                                <div class="text-xl font-bold text-blue-600">
                                    NGN {{ number_format($hotelPrice, 0) }}<span
                                        class="text-sm text-gray-500 font-normal">/booking</span>
                                </div>
                            </div>
                        </div>
                        <ul class="space-y-2 mb-5">
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Hotel Booking Confirmation</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Embassy Accepted Format</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Verifiable Booking Reference</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>10 – 60 minutes (during our opening hours)</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Valid Until one week before arrival</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>24/7 Support</span>
                            </li>
                        </ul>
                        <button type="button" data-scroll-target="#booking-form" data-tab-target="hotel"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-all whitespace-nowrap cursor-pointer">
                            Book Now
                        </button>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-7 border-2 border-blue-500 hover:shadow-lg transition-all relative">
                        <span
                            class="absolute -top-2 left-1/2 -translate-x-1/2 bg-blue-600 text-white px-3 py-0.5 rounded-full text-[10px] font-bold whitespace-nowrap">
                            Most Popular
                        </span>
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                                <img alt="Combo" class="h-7 w-7" src="{{ asset('images/icons/combo-white.svg') }}" />
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    Flight + Hotel
                                </h3>
                                <div class="text-xl font-bold text-blue-600">
                                    NGN {{ number_format($comboPrice, 0) }}<span
                                        class="text-sm text-gray-500 font-normal line-through ml-1">NGN
                                        {{ number_format($comboBase, 0) }}</span>
                                </div>
                            </div>
                        </div>
                        <ul class="space-y-2 mb-5">
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Flight Reservation PDF</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Hotel Booking Confirmation</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Embassy Accepted Format</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>All Verifiable Codes</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>10 – 60 minutes (during our opening hours)</span>
                            </li>
                            <li class="flex items-center gap-2 text-sm text-gray-600">
                                <img alt="Check" class="h-4 w-4" src="{{ asset('images/icons/check.svg') }}" /><span>Priority Support</span>
                            </li>
                        </ul>
                        <button type="button" data-scroll-target="#booking-form" data-tab-target="combo"
                            class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-all whitespace-nowrap cursor-pointer">
                            Book Package
                        </button>
                    </div>
                </div>
            </div>
        </section>
        @include('partials.testimonials')
        <section id="faq" class="py-16 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-base text-gray-600">
                        Quick answers to common questions
                    </p>
                </div>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <button type="button" data-faq-trigger
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors cursor-pointer">
                            <span class="font-semibold text-gray-900 text-sm pr-4">How long does it take to
                                receive my
                                documents?</span><img data-faq-icon
                                class="h-5 w-5 flex-shrink-0 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle">
                        </button>
                        <div data-faq-content class="px-6 pb-4 text-sm text-gray-600">
                            Delivery is typically within 30-60 minutes
                            during working hours, and up to 6 hours
                            during peak periods.
                        </div>
                    </div>
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <button type="button" data-faq-trigger
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors cursor-pointer">
                            <span class="font-semibold text-gray-900 text-sm pr-4">Are these documents accepted
                                by
                                embassies?</span><img data-faq-icon
                                class="h-5 w-5 flex-shrink-0 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle">
                        </button>
                        <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600">
                            Yes. All reservations are verifiable and
                            designed to meet embassy and immigration
                            requirements.
                        </div>
                    </div>
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <button type="button" data-faq-trigger
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors cursor-pointer">
                            <span class="font-semibold text-gray-900 text-sm pr-4">How long are the
                                reservations
                                valid?</span><img data-faq-icon
                                class="h-5 w-5 flex-shrink-0 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle">
                        </button>
                        <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600">
                            Flight reservations are typically valid up
                            to 2 weeks, and hotel confirmations up to
                            3 weeks.
                        </div>
                    </div>
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <button type="button" data-faq-trigger
                            class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors cursor-pointer">
                            <span class="font-semibold text-gray-900 text-sm pr-4">What is your refund and cancellation policy?</span><img data-faq-icon
                                class="h-5 w-5 flex-shrink-0 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle">
                        </button>
                        <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600">
                            Reservations are non-refundable once delivered. Refunds may be considered only if we cannot
                        provide a valid booking due to technical issues or system failures. Duplicate payments will be
                        reviewed and refunded if confirmed.
                        </div>
                    </div>
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <button type="button" data-faq-trigger
                                class="w-full px-6 py-4 flex items-center justify-between text-left hover:bg-gray-50 transition-colors cursor-pointer">
                            <span class="font-semibold text-gray-900 text-sm pr-4">Do you offer support if my visa application is rejected?</span><img data-faq-icon
                                class="h-5 w-5 flex-shrink-0 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle">
                        </button>
                        <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600">
                            While we cannot guarantee visa approval (as this is determined by the embassy), we provide 24/7
                        consultation support. If your application is rejected, we can review the reasons and provide
                        guidance for future applications. You can also request a
                        <a class="text-blue-600 font-semibold hover:underline" href="{{ route('visa.consultation') }}">visa consultation</a>
                        for expert guidance.
                        </div>
                    </div>
                </div>
                <div class="text-center mt-8">
                    <a class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors cursor-pointer"
                        href="{{ route('faq') }}">
                        View All FAQs
                        <img alt="Arrow" class="h-4 w-4 brightness-0 invert" src="{{ asset('images/icons/arrow-right.svg') }}" />
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
