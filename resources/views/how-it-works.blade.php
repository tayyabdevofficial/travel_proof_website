@extends('layouts.main')
@section('title', 'How It Works')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-title', 'How It Works')
@section('page-hero-subtitle', 'Get your visa documents in 3 simple steps')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-12">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1 order-2 md:order-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full font-bold text-2xl flex items-center justify-center shadow-lg">
                                1
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Fill Simple Form</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Start by selecting your service (Flight, Hotel, or Combo Package) and fill in your travel
                            details. Our secure form is designed to be quick and easy - it takes less than 2 minutes to
                            complete.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Enter your travel dates and destinations</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Provide passenger information (must match passport)</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Add your contact details for delivery</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex-1 order-1 md:order-2">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 shadow-xl border border-blue-200">
                            <div class="w-full h-64 bg-white rounded-lg flex items-center justify-center">
                                <img alt="Fill Form" class="w-full h-full object-cover rounded-lg"
                                    src="{{ asset('images/simple-form.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 shadow-xl border border-blue-200">
                            <div class="w-full h-64 bg-white rounded-lg flex items-center justify-center">
                                <img alt="Make Payment" class="w-full h-full object-cover rounded-lg"
                                    src="{{ asset('images/make-payment.jpg') }}">
                            </div>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full font-bold text-2xl flex items-center justify-center shadow-lg">
                                2
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Make Payment</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            After submitting your booking, our team will contact you with secure payment instructions.
                            We accept multiple payment methods for your convenience.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Bank transfer (local and international)</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Credit/Debit cards</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Mobile money and digital wallets</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>All transactions are encrypted and secure</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="flex-1 order-2 md:order-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-full font-bold text-2xl flex items-center justify-center shadow-lg">
                                3
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Receive Documents</h3>
                        </div>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Once payment is confirmed, we'll process your request immediately. Your embassy-approved
                            documents will be delivered to your email within 30 minutes.
                        </p>
                        <ul class="space-y-2">
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Professional PDF documents ready to print</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Verifiable PNR codes and booking references</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>Accepted by embassies worldwide</span>
                            </li>
                            <li class="flex items-start gap-2 text-gray-700">
                                <img alt="Check" class="h-4 w-4 mt-1" src="{{ asset('images/icons/check.svg') }}" />
                                <span>24/7 support if you need assistance</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex-1 order-1 md:order-2">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 shadow-xl border border-blue-200">
                            <div class="w-full h-64 bg-white rounded-lg flex items-center justify-center">
                                <img alt="Receive Documents" class="w-full h-full object-cover rounded-lg"
                                    src="{{ asset('images/receive-document.jpg') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Why Choose Us?</h2>
                <p class="text-gray-600">We make visa applications easier and faster</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Fast" class="h-6 w-6" src="{{ asset('images/icons/clock.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Fast Processing</h3>
                    <p class="text-sm text-gray-600">
                        Get your documents within 30 minutes during business hours. We prioritize speed without
                        compromising quality.
                    </p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Verified" class="h-6 w-6" src="{{ asset('images/icons/shield-check.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Embassy Approved</h3>
                    <p class="text-sm text-gray-600">
                        99.2% acceptance rate at embassies worldwide. Our documents meet all official requirements.
                    </p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Support" class="h-6 w-6" src="{{ asset('images/icons/chat.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">24/7 Support</h3>
                    <p class="text-sm text-gray-600">
                        Our dedicated support team is always available to help you with any questions or concerns.
                    </p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Secure" class="h-6 w-6" src="{{ asset('images/icons/lock.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Secure &amp; Private</h3>
                    <p class="text-sm text-gray-600">
                        Your personal information is encrypted and protected. We never share your data with third
                        parties.
                    </p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Document" class="h-6 w-6" src="{{ asset('images/icons/document.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Verifiable Documents</h3>
                    <p class="text-sm text-gray-600">
                        All reservations include genuine PNR codes that can be verified on airline and hotel websites.
                    </p>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <img alt="Pricing" class="h-6 w-6" src="{{ asset('images/icons/currency.svg') }}" />
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Affordable Pricing</h3>
                    <p class="text-sm text-gray-600">
                        Competitive rates with no hidden fees. Save money with our combo packages.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-lg text-blue-100 mb-8">
                Join thousands of travelers who trust us for their visa applications
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('flight.booking') }}"
                    class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer">
                    Book Flight Reservation
                </a>
                <a href="{{ route('combo.booking') }}"
                    class="bg-blue-800 text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer border-2 border-white">
                    Get Combo Package
                </a>
            </div>
        </div>
    </section>
@endsection

