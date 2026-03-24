@extends('layouts.main')
@section('title', 'Thank You')
@section('body-class', 'bg-gray-50')
@section('main-class', 'pt-24')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                    <div class="bg-white rounded-xl border border-gray-200 p-8 shadow-sm">
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            Thank You!
                        </h1>
                        <p class="text-sm text-gray-600 mb-6">
                            Your payment was successful and your request is being processed.
                        </p>
                        <div class="text-sm text-gray-700">
                            Tracking ID:
                            <span class="font-semibold text-blue-600">{{
                                $booking->tracking_id
                            }}</span>
                        </div>
                        <div class="mt-4 flex flex-col sm:flex-row items-center justify-center gap-3">
                            <a href="{{ route('track.show', $booking->tracking_id) }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold text-sm hover:bg-blue-700 transition-colors">
                                Track Booking
                            </a>
                            <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg border border-blue-200 text-blue-700 font-semibold text-sm hover:bg-blue-50 transition-colors">
                                Back to Home
                            </a>
                        </div>
                        <div class="text-xs text-gray-500 mt-4">
                            Your booking confirmation PDF will be sent to your email within a few hours. Please check your inbox (and spam/junk folder).
                        </div>
                    </div>
                </div>
@endsection
