@extends('layouts.main')
@section('title', 'Contact Us')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')
@section('page-hero-icon')
    <img alt="Support" class="h-10 w-10" src="{{ asset('images/icons/chat.svg') }}" />
@endsection
@section('page-hero-title', 'Contact Us')
@section('page-hero-subtitle', "We're here to help you 24/7")

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Send Us a Message</h2>
                    <p class="text-gray-600 mb-6">Fill out the form and we'll get back to you shortly</p>

                    @if (session('status'))
                        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="space-y-5" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name <span class="text-red-500">*</span></label>
                            <input required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                placeholder="Enter your full name" type="text" name="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                            <input required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                placeholder="your.email@example.com" type="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                placeholder="{{ config('site.phone') }}" type="tel" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Subject <span class="text-red-500">*</span></label>
                            <select name="subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                <option value="">Select a subject</option>
                                <option value="booking-inquiry" @selected(old('subject') === 'booking-inquiry')>Booking Inquiry</option>
                                <option value="payment-issue" @selected(old('subject') === 'payment-issue')>Payment Issue</option>
                                <option value="document-verification" @selected(old('subject') === 'document-verification')>Document Verification</option>
                                <option value="technical-support" @selected(old('subject') === 'technical-support')>Technical Support</option>
                                <option value="general-question" @selected(old('subject') === 'general-question')>General Question</option>
                                <option value="other" @selected(old('subject') === 'other')>Other</option>
                            </select>
                            @error('subject')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message <span class="text-red-500">*</span></label>
                            <textarea name="message" required maxlength="500"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                                placeholder="Tell us how we can help you..." rows="5">{{ old('message') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Maximum 500 characters</p>
                            @error('message')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" data-submit-btn
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-semibold hover:shadow-lg transition-all whitespace-nowrap cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed">
                            Send Message
                        </button>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Get In Touch</h2>
                        <div class="space-y-5">
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <img alt="Email" class="h-6 w-6" src="{{ asset('images/icons/mail.svg') }}" />
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                    <a href="mailto:{{ config('site.email') }}"
                                        class="text-gray-600 hover:text-blue-600 transition-colors">{{ config('site.email') }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <img alt="Phone" class="h-6 w-6" src="{{ asset('images/icons/phone.svg') }}" />
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Phone</h3>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', config('site.phone')) }}"
                                        class="text-gray-600 hover:text-blue-600 transition-colors">{{ config('site.phone') }}</a>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <img alt="Time" class="h-6 w-6" src="{{ asset('images/icons/clock.svg') }}" />
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Business Hours</h3>
                                    <p class="text-gray-600">Monday – Sunday</p>
                                    <p class="text-sm text-gray-500">10:00 AM – 6:00 PM (WAT)</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <img alt="Location" class="h-6 w-6" src="{{ asset('images/icons/map-pin.svg') }}" />
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 mb-1">Address</h3>
                                    <p class="text-gray-600">
                                        {!! nl2br(config('site.address')) !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Follow Us</h2>
                        <div class="flex items-center gap-3">
                            <a href="{{ config('site.socials.facebook') }}" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-blue-100 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors group">
                                <img alt="Facebook" class="h-5 w-5 transition group-hover:brightness-0 group-hover:invert"
                                    src="{{ asset('images/icons/facebook.svg') }}" />
                            </a>
                            <a href="{{ config('site.socials.instagram') }}" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-blue-100 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors group">
                                <img alt="Instagram" class="h-5 w-5 transition group-hover:brightness-0 group-hover:invert"
                                    src="{{ asset('images/icons/instagram.svg') }}" />
                            </a>
                            <a href="{{ config('site.socials.twitter') }}" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-blue-100 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors group">
                                <img alt="Twitter" class="h-5 w-5 transition group-hover:brightness-0 group-hover:invert"
                                    src="{{ asset('images/icons/twitter.svg') }}" />
                            </a>
                            <a href="{{ config('site.whatsapp') }}" target="_blank" rel="noopener noreferrer"
                                class="w-12 h-12 bg-blue-100 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors group">
                                <img alt="WhatsApp" class="h-5 w-5 transition group-hover:brightness-0 group-hover:invert"
                                    src="{{ asset('images/icons/whatsapp.svg') }}" />
                            </a>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-200 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Links</h2>
                        <div class="space-y-3">
                            <a href="{{ route('faq') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <img alt="FAQ" class="h-4 w-4" src="{{ asset('images/icons/question.svg') }}" /><span>Frequently Asked Questions</span>
                            </a>
                            <a href="{{ route('how.it.works') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <img alt="Info" class="h-4 w-4" src="{{ asset('images/icons/info.svg') }}" /><span>How It Works</span>
                            </a>
                            <a href="{{ route('sample') }}"
                                class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors">
                                <img alt="Docs" class="h-4 w-4" src="{{ asset('images/icons/document.svg') }}" /><span>Sample Documents</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const contactForm = document.querySelector('form[action="{{ route('contact.store') }}"]');
            if (contactForm) {
                contactForm.addEventListener('submit', () => {
                    const button = contactForm.querySelector('[data-submit-btn]');
                    if (!button) return;
                    button.disabled = true;
                    button.innerHTML = '<span class="inline-flex items-center gap-2"><span class="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>Sending...</span>';
                });
            }
        </script>
    @endpush
@endsection

