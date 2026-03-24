@extends('layouts.main')
@section('title', 'Privacy Policy')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-title', 'Privacy Policy')
@section('page-hero-subtitle', 'How we handle your data and protect your privacy')

@section('content')
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose-blue">
                <p>
                    We respect your privacy and are committed to protecting your personal information. This Privacy
                    Policy explains what data we collect, how we use it, and the choices you have.
                </p>
                <h2>Information We Collect</h2>
                <ul>
                    <li>Contact details such as name, email, and phone number.</li>
                    <li>Travel information you submit through our booking and consultation forms.</li>
                    <li>Technical data such as browser type and device information for analytics.</li>
                </ul>
                <h2>How We Use Your Information</h2>
                <ul>
                    <li>To process bookings and deliver your documents.</li>
                    <li>To communicate with you regarding your requests.</li>
                    <li>To improve our services and website performance.</li>
                </ul>
                <h2>Data Security</h2>
                <p>
                    We use industry-standard security measures to protect your information. Access is restricted to
                    authorized personnel only.
                </p>
                <h2>Third-Party Sharing</h2>
                <p>
                    We do not sell your personal information. We only share data with trusted partners necessary to
                    deliver our services.
                </p>
                <h2>Your Rights</h2>
                <p>
                    You can request access, updates, or deletion of your personal information by contacting our support
                    team.
                </p>
                <h2>Contact Us</h2>
                <p>
                    If you have questions about this Privacy Policy, contact us at
                    <strong>{{ config('site.email') }}</strong>.
                </p>
            </div>
        </div>
    </section>
@endsection
