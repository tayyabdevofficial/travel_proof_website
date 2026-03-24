@extends('layouts.main')
@section('title', 'Terms & Conditions')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-title', 'Terms & Conditions')
@section('page-hero-subtitle', 'Please review the terms governing our services')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose-blue">
                <p>
                    These Terms & Conditions outline the rules and guidelines for using our services. By placing an
                    order, you agree to these terms.
                </p>
                <h2>Service Scope</h2>
                <p>
                    We provide reservation documents for visa application purposes only. These documents are not valid
                    for travel or hotel check-in.
                </p>
                <h2>Delivery</h2>
                <p>
                    Documents are delivered within the stated timeframe after payment confirmation. Delivery times may
                    vary during peak periods.
                </p>
                <h2>Refund Policy</h2>
                <p>
                    Reservations are non-refundable once delivered. Refunds may be considered only if we cannot
                    provide a valid booking due to technical issues or system failures.
                </p>
                <h2>User Responsibilities</h2>
                <ul>
                    <li>Provide accurate and truthful information.</li>
                    <li>Use documents solely for visa application purposes.</li>
                    <li>Contact support immediately if errors are found.</li>
                </ul>
                <h2>Limitation of Liability</h2>
                <p>
                    We are not responsible for visa application outcomes, which are determined by the relevant embassy
                    or consulate.
                </p>
                <h2>Contact</h2>
                <p>
                    For questions regarding these terms, contact us at
                    <strong>{{ config('site.email') }}</strong>.
                </p>
            </div>
        </div>
    </section>
@endsection
