@extends('layouts.main')
@section('title', 'Flight + Hotel Package')
@section('body-class', 'bg-gray-50')
@section('main-class', 'pt-16')
@section('default-tab', 'combo')

@php
    $flightPrice = (float) ($pricing->flight_price ?? 5000);
    $hotelPrice = (float) ($pricing->hotel_price ?? 4000);
    $discountPercent = (float) ($pricing->combo_discount_percent ?? 0);
    $comboBase = $flightPrice + $hotelPrice;
    $comboPrice = $comboBase * (1 - $discountPercent / 100);
    $comboSavings = $comboBase - $comboPrice;
@endphp
@section('page-hero-icon')
    <img alt="Combo" class="h-10 w-10" src="{{ asset('images/icons/combo.svg') }}" />
@endsection
@section('page-hero-title', 'Flight + Hotel Package')
@section('page-hero-subtitle', "Complete visa documentation package - Save NGN " . number_format($comboSavings, 0) . " with our bundle")

@section('content')
    @php
        $flightPrice = (float) ($pricing->flight_price ?? 5000);
        $hotelPrice = (float) ($pricing->hotel_price ?? 4000);
        $discountPercent = (float) ($pricing->combo_discount_percent ?? 0);
        $comboBase = $flightPrice + $hotelPrice;
    @endphp

    <section class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('partials.forms.booking-form', ['showTabs' => false, 'activeTab' => 'combo'])
        </div>
    </section>

@endsection

