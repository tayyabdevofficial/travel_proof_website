@extends('layouts.main')
@section('title', 'Consultation Confirmed')
@section('body-class', 'bg-white')
@section('main-class', 'pt-24')

@section('content')
    <section class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 text-center">
                <div class="mx-auto w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-4">
                    <img src="/images/icons/check.svg" alt="" class="w-8 h-8">
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Thank You!</h1>
                <p class="text-gray-600 mb-6">
                    Your payment was successful, and your request is now being processed.
                </p>
                <div class="text-sm text-gray-700 space-y-2 mb-6">
                    <div><strong>Tracking ID:</strong> {{ $consultation->tracking_id }}</div>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <a href="{{ route('visa.consultation.track.show', $consultation->tracking_id) }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors">
                        Track Consultation
                    </a>
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg border border-blue-200 text-blue-700 font-semibold hover:bg-blue-50 transition-colors">
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
