@extends('layouts.main')
@section('title', 'About Us')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-title', 'About Us')
@section('page-hero-subtitle', 'Your trusted partner for visa documentation')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Mission</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        We're dedicated to making visa applications easier and more accessible for travelers worldwide.
                        Our mission is to provide authentic, embassy-approved flight reservations and hotel
                        confirmations that help you achieve your travel dreams.
                    </p>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Since our founding, we've helped over 25,000 travelers successfully obtain their visas by
                        providing professional documentation services that meet embassy requirements.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        We understand the stress and complexity of visa applications, which is why we've streamlined
                        the process to be fast, reliable, and affordable.
                    </p>
                </div>
                <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 shadow-xl border border-blue-200">
                    <img alt="Our Team" class="w-full h-auto rounded-lg" src="{{ asset('images/about.jpg') }}">
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gradient-to-br from-blue-50 to-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Our Impact</h2>
                <p class="text-gray-600">Numbers that speak for themselves</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">25,000+</div>
                    <div class="text-sm text-gray-600">Happy Customers</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">99.2%</div>
                    <div class="text-sm text-gray-600">Approval Rate</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">100+</div>
                    <div class="text-sm text-gray-600">Countries Served</div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">24/7</div>
                    <div class="text-sm text-gray-600">Support Available</div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Our Values</h2>
                <p class="text-gray-600">What drives us every day</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/shield-check.svg" alt="" class="w-8 h-8">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Authenticity</h3>
                    <p class="text-gray-600 leading-relaxed">
                        We provide only genuine, verifiable documents that meet embassy standards. No fake bookings, no
                        shortcuts.
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/chat.svg" alt="" class="w-8 h-8">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Customer First</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Your success is our success. We're committed to providing exceptional service and support at
                        every step.
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/bolt.svg" alt="" class="w-8 h-8 brightness-0" style="filter: invert(33%) sepia(86%) saturate(1804%) hue-rotate(201deg) brightness(96%) contrast(95%);">
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Speed &amp; Reliability</h3>
                    <p class="text-gray-600 leading-relaxed">
                        We understand time is critical. Fast processing without compromising quality or accuracy.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Why Choose Us?</h2>
                <p class="text-gray-600">What makes us different</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img src="/images/icons/check-badge.svg" alt="" class="w-6 h-6">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Embassy Approved</h3>
                            <p class="text-sm text-gray-600">
                                Our documents are accepted by embassies and consulates worldwide with a 99.2% success
                                rate.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img src="/images/icons/clock.svg" alt="" class="w-6 h-6">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Fast Delivery</h3>
                            <p class="text-sm text-gray-600">
                                Receive your documents within 30 minutes. We prioritize urgent requests and work
                                around the clock.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img src="/images/icons/lock.svg" alt="" class="w-6 h-6">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Secure &amp; Private</h3>
                            <p class="text-sm text-gray-600">
                                Your personal information is encrypted and protected. We never share your data with
                                third parties.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img src="/images/icons/currency.svg" alt="" class="w-6 h-6">
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Affordable Pricing</h3>
                            <p class="text-sm text-gray-600">
                                Competitive rates with no hidden fees. Save more with our combo packages.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Our Commitment</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    We're a team of travel professionals, visa experts, and customer service specialists dedicated to
                    making your visa application process as smooth as possible. With years of experience in the travel
                    industry, we understand what embassies require and how to deliver it efficiently.
                </p>
            </div>
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 md:p-12 text-white text-center">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Ready to Start Your Journey?</h3>
                <p class="text-lg text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join thousands of satisfied travelers who trust us for their visa documentation needs
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('flight.booking') }}"
                        class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer">
                        Get Started Now
                    </a>
                    <a href="{{ route('contact') }}#contact"
                        class="bg-blue-800 text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer border-2 border-white">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
