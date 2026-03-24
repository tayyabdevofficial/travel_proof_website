@extends('layouts.main')
@section('title', 'Frequently Asked Questions')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-icon')
    <img alt="FAQ" class="h-10 w-10" src="{{ asset('images/icons/question.svg') }}" />
@endsection
@section('page-hero-title', 'Frequently Asked Questions')
@section('page-hero-subtitle', 'Find answers to common questions about our services')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">Will embassies accept these reservations?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform rotate-180" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        Yes! Our reservations have a 99.2% acceptance rate at embassies worldwide. We provide authentic
                        PNR codes from real airline systems that embassies can verify. Our hotel bookings come with a
                        unique booking number and are valid for up to 3 weeks.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">How long does it take to receive my reservation?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        Most reservations are delivered within 10-60 minutes during our working hours (24/7 support
                        available). For urgent requests, please contact our support team and we can prioritize your
                        order.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">Can these reservations be used for actual travel?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        No. The reservations we provide are specifically for visa application purposes only and cannot
                        be used for boarding flights or checking into hotels. They are temporary bookings designed to
                        meet embassy requirements.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">Do you offer support if my visa application is rejected?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        While we cannot guarantee visa approval (as this is determined by the embassy), we provide 24/7
                        consultation support. If your application is rejected, we can review the reasons and provide
                        guidance for future applications.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">What is your refund and cancellation policy?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        Reservations are non-refundable once delivered. Refunds may be considered only if we cannot
                        provide a valid booking due to technical issues or system failures. Duplicate payments will be
                        reviewed and refunded if confirmed.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">How can I verify my booking?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        All flight reservations include a PNR code that can be verified on the airline's official
                        website. Hotel bookings include a confirmation number that can be checked with the hotel
                        directly. We provide full verification instructions with your documents.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">What payment methods do you accept?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        We accept bank transfers (local and international), credit/debit cards, mobile money, and
                        digital wallets. All transactions are encrypted and secure. Payment instructions will be
                        provided after you submit your booking.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">Can I make changes to my booking after submission?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        Minor changes can be made before payment is processed. After payment and document delivery,
                        changes may require a new booking. Please contact our support team immediately if you need to
                        make changes.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">Do you provide documents for all countries?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        Yes! Our documents are accepted by embassies and consulates worldwide, including UK, US,
                        Canada, Schengen countries, Australia, and many others. We have successfully helped travelers
                        apply for visas to over 100 countries.
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                    <button type="button" data-faq-trigger
                        class="w-full px-6 py-4 flex items-center justify-between text-left cursor-pointer hover:bg-gray-50 transition-colors">
                        <span class="font-semibold text-gray-900 text-base pr-4">Is my personal information secure?</span>
                        <div class="w-6 h-6 flex items-center justify-center flex-shrink-0">
                            <img data-faq-icon class="h-5 w-5 transition-transform" src="{{ asset('images/icons/chevron-down.svg') }}" alt="Toggle" />
                        </div>
                    </button>
                    <div data-faq-content class="hidden px-6 pb-4 text-sm text-gray-600 leading-relaxed">
                        Absolutely. We use industry-standard encryption to protect your personal and payment
                        information. We never share your data with third parties, and all information is stored
                        securely in compliance with international data protection regulations.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Need More Help?</h2>
                <p class="text-gray-600">Browse by category or contact our support team</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Flight" class="h-6 w-6" src="{{ asset('images/icons/airplane-white.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Flight Reservations</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Questions about flight booking process, PNR codes, and delivery times
                    </p>
                    <a href="{{ route('flight.booking') }}"
                        class="text-blue-600 font-semibold text-sm hover:text-blue-700 flex items-center gap-1">
                        Book Flight <img alt="Arrow" class="h-4 w-4" src="{{ asset('images/icons/arrow-right.svg') }}" />
                    </a>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Hotel" class="h-6 w-6 brightness-0 invert" src="{{ asset('images/icons/hotel-blue.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Hotel Confirmations</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Information about hotel booking confirmations and verification
                    </p>
                    <a href="{{ route('hotel.booking') }}"
                        class="text-blue-600 font-semibold text-sm hover:text-blue-700 flex items-center gap-1">
                        Book Hotel <img alt="Arrow" class="h-4 w-4" src="{{ asset('images/icons/arrow-right.svg') }}" />
                    </a>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-xl p-6 border border-blue-200 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Support" class="h-6 w-6 brightness-0 invert" src="{{ asset('images/icons/chat.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Customer Support</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Get help from our 24/7 support team via email, phone, or chat
                    </p>
                    <a href="{{ route('contact') }}"
                        class="text-blue-600 font-semibold text-sm hover:text-blue-700 flex items-center gap-1">
                        Contact Us <img alt="Arrow" class="h-4 w-4" src="{{ asset('images/icons/arrow-right.svg') }}" />
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Still Have Questions?</h2>
            <p class="text-lg text-blue-100 mb-8">Our support team is available 24/7 to help you</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}"
                    class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer">
                    Contact Support
                </a>
                <a href="mailto:{{ config('site.email') }}"
                    class="bg-blue-800 text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer border-2 border-white">
                    Email Us
                </a>
            </div>
        </div>
    </section>
@endsection

