@extends('layouts.main')
@section('title', 'Hotel Booking Confirmation')
@section('body-class', 'bg-gray-50')
@section('main-class', 'pt-16')
@section('default-tab', 'hotel')

@section('page-hero-icon')
    <img alt="Hotel" class="h-10 w-10" src="{{ asset('images/icons/hotel.svg') }}" />
@endsection
@section('page-hero-title', 'Hotel Booking Confirmation')
@section('page-hero-subtitle', 'Get your embassy-approved hotel confirmation in minutes')

@section('content')
    @php
        $flightPrice = (float) ($pricing->flight_price ?? 5000);
        $hotelPrice = (float) ($pricing->hotel_price ?? 4000);
        $discountPercent = (float) ($pricing->combo_discount_percent ?? 0);
        $comboBase = $flightPrice + $hotelPrice;
    @endphp

    <section class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.forms.booking-form', ['showTabs' => false, 'activeTab' => 'hotel'])
        </div>
    </section>
@endsection

