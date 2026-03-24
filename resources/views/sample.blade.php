@extends('layouts.main')
@section('title', 'Sample Documents')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-icon')
    <img src="/images/icons/file-text.svg" alt="" class="w-10 h-10">
@endsection
@section('page-hero-title', 'Sample Documents')
@section('page-hero-subtitle', 'See what your visa documents will look like')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Professional Embassy-Ready Documents</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    All our documents are professionally formatted and include verifiable booking references accepted
                    by embassies worldwide
                </p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <img src="/images/icons/airplane-white.svg" alt="" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="text-xl font-bold">Flight Reservation</h3>
                                <p class="text-sm text-blue-100">Sample Document</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-100 rounded-lg p-4 mb-6 aspect-[3/4] flex items-center justify-center">
                            <img alt="Flight Reservation Sample" class="w-full h-full object-contain"
                                src="{{ asset('images/sample-flight.png') }}">
                        </div>
                        <div class="space-y-3 mb-6">
                            <h4 class="font-bold text-gray-900">Includes:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Verifiable PNR (Passenger Name Record) code</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Flight details (departure, arrival, dates)</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Passenger information matching passport</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Airline booking reference</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Valid for 2 weeks</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('flight.booking') }}"
                            class="block w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-all text-center">
                            Book Flight Reservation
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                                <img src="/images/icons/hotel-blue.svg" alt="" class="w-6 h-6 brightness-0 invert">
                            </div>
                            <div>
                                <h3 class="text-xl font-bold">Hotel Confirmation</h3>
                                <p class="text-sm text-blue-100">Sample Document</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-100 rounded-lg p-4 mb-6 aspect-[3/4] flex items-center justify-center">
                            <img alt="Hotel Confirmation Sample" class="w-full h-full object-contain"
                                src="{{ asset('images/sample-hotel.png') }}">
                        </div>
                        <div class="space-y-3 mb-6">
                            <h4 class="font-bold text-gray-900">Includes:</h4>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Unique booking reference number</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Hotel details and address</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Check-in and check-out dates</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Guest information</span>
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-700">
                                    <img src="/images/icons/check.svg" alt="" class="w-4 h-4 mt-0.5">
                                    <span>Valid for 3 weeks</span>
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('hotel.booking') }}"
                            class="block w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-all text-center">
                            Book Hotel Confirmation
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-3">Document Features</h2>
                <p class="text-gray-600">What makes our documents embassy-approved</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/shield-check.svg" alt="" class="w-6 h-6">
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Verified Codes</h3>
                    <p class="text-sm text-gray-600">
                        All booking codes can be verified on official airline and hotel websites
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/file-text.svg" alt="" class="w-6 h-6">
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Professional Format</h3>
                    <p class="text-sm text-gray-600">
                        Documents follow official formatting standards accepted by embassies
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/printer.svg" alt="" class="w-6 h-6">
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Print Ready</h3>
                    <p class="text-sm text-gray-600">
                        High-quality PDF files ready to print for your visa application
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="/images/icons/globe.svg" alt="" class="w-6 h-6">
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Worldwide Acceptance</h3>
                    <p class="text-sm text-gray-600">
                        Accepted by embassies and consulates in all countries
                    </p>
                </div>
            </div>
        </div>
    </section>

    @include('partials.testimonials', [
        'title' => 'What Our Customers Say',
        'subtitle' => 'Real feedback from successful visa applicants',
        'columns' => 'md:grid-cols-3',
        'class' => 'bg-gray-50',
    ])

    <section class="py-16 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Get Your Documents?</h2>
            <p class="text-lg text-blue-100 mb-8">Start your visa application with confidence</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('flight.booking') }}"
                    class="bg-white text-blue-600 px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer">
                    Book Now
                </a>
                <a href="{{ route('contact') }}#contact"
                    class="bg-blue-800 text-white px-8 py-4 rounded-lg font-bold hover:shadow-2xl transition-all hover:scale-105 whitespace-nowrap cursor-pointer border-2 border-white">
                    Contact Support
                </a>
            </div>
        </div>
    </section>
@endsection
