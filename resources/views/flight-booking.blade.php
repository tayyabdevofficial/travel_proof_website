@extends('layouts.main')
@section('title', 'Flight Reservation')
@section('body-class', 'bg-gray-50')
@section('main-class', 'pt-16')
@section('default-tab', 'flight')

@section('page-hero-icon')
    <img alt="Flight" class="h-10 w-10" src="{{ asset('images/icons/airplane.svg') }}" />
@endsection
@section('page-hero-title', 'Flight Reservation')
@section('page-hero-subtitle', 'Get your embassy-approved flight reservation in minutes')

@section('content')
    @php
        $flightPrice = (float) ($pricing->flight_price ?? 5000);
        $hotelPrice = (float) ($pricing->hotel_price ?? 4000);
        $discountPercent = (float) ($pricing->combo_discount_percent ?? 0);
        $comboBase = $flightPrice + $hotelPrice;
    @endphp

    <section class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.forms.booking-form', ['showTabs' => false, 'activeTab' => 'flight'])

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img alt="Verified" class="h-6 w-6" src="{{ asset('images/icons/shield-check.svg') }}" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">Embassy Verified</h4>
                            <p class="text-xs text-gray-600">Accepted worldwide</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img alt="Fast" class="h-6 w-6" src="{{ asset('images/icons/clock.svg') }}" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">Fast Delivery</h4>
                            <p class="text-xs text-gray-600">Within 30 minutes</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <img alt="Support" class="h-6 w-6" src="{{ asset('images/icons/chat.svg') }}" />
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900 text-sm">24/7 Support</h4>
                            <p class="text-xs text-gray-600">Always here to help</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

