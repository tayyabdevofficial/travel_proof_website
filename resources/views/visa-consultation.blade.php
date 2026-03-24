@extends('layouts.main')
@section('title', 'Visa Consultation')
@section('body-class', 'bg-white')
@section('main-class', 'pt-16')

@section('content')
    @php
        $consultationFee = (float) ($pricing->consultation_fee ?? 50000);
    @endphp

    <section class="bg-gradient-to-br from-blue-50 to-white pt-32 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                    Professional Visa Consultation Services
                </h1>
                <p class="text-xl text-gray-600 mb-8">
                    Get expert guidance for your visa application. Our experienced consultants will help you navigate
                    the entire process with confidence.
                </p>
                <div class="flex items-center justify-center gap-8 text-sm text-gray-600">
                    <div class="flex items-center gap-2">
                        <img src="/images/icons/shield-check.svg" alt="" class="w-6 h-6"><span>Expert Advisors</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="/images/icons/clock.svg" alt="" class="w-6 h-6"><span>Fast Processing</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <img src="/images/icons/chat.svg" alt="" class="w-6 h-6"><span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Choose Our Visa Consultation?</h2>
                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg flex-shrink-0">
                                <img src="/images/icons/user.svg" alt="" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Experienced Consultants</h3>
                                <p class="text-gray-600">
                                    Our team has helped thousands of clients successfully obtain visas for various
                                    countries.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg flex-shrink-0">
                                <img src="/images/icons/doc-list.svg" alt="" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Document Review</h3>
                                <p class="text-gray-600">
                                    Complete review of your documents to ensure everything meets embassy requirements.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg flex-shrink-0">
                                <img src="/images/icons/chat.svg" alt="" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Interview Preparation</h3>
                                <p class="text-gray-600">
                                    Mock interviews and tips to help you confidently answer visa interview questions.
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-lg flex-shrink-0">
                                <img src="/images/icons/roadmap.svg" alt="" class="w-6 h-6">
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Step-by-Step Guidance</h3>
                                <p class="text-gray-600">
                                    From application to approval, we guide you through every step of the visa process.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <img alt="Visa Consultation" class="w-full h-full object-cover rounded-2xl shadow-xl"
                        src="{{ asset('images/about.jpg') }}">
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-8 md:p-12 text-white text-center mb-16">
                <h3 class="text-3xl font-bold mb-4">Consultation Fee</h3>
                <div class="text-6xl font-bold mb-4">₦{{ number_format($consultationFee, 0) }}</div>
                <p class="text-xl mb-6 text-blue-100">One-time comprehensive consultation package</p>
                <ul class="text-left max-w-md mx-auto space-y-3 mb-8">
                    <li class="flex items-center gap-3"><img src="/images/icons/check.svg" alt="" class="w-5 h-5 brightness-0 invert"><span>Complete document
                            review and verification</span></li>
                    <li class="flex items-center gap-3"><img src="/images/icons/check.svg" alt="" class="w-5 h-5 brightness-0 invert"><span>Personalized visa
                            application strategy</span></li>
                    <li class="flex items-center gap-3"><img src="/images/icons/check.svg" alt="" class="w-5 h-5 brightness-0 invert"><span>Interview
                            preparation and mock sessions</span></li>
                    <li class="flex items-center gap-3"><img src="/images/icons/check.svg" alt="" class="w-5 h-5 brightness-0 invert"><span>Follow-up support
                            until visa approval</span></li>
                    <li class="flex items-center gap-3"><img src="/images/icons/check.svg" alt="" class="w-5 h-5 brightness-0 invert"><span>Access to our visa
                            resource library</span></li>
                </ul>
            </div>

            <div class="max-w-3xl mx-auto" id="consultation-form">
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2 text-center">Book Your Consultation</h2>
                    <p class="text-gray-600 text-center mb-8">
                        Fill in your details and our visa experts will contact you within 24 hours
                    </p>

                    @if (session('status'))
                        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('visa.consultation.store') }}">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                    placeholder="Enter your full name" type="text" value="{{ old('fullName') }}"
                                    name="fullName">
                                @error('fullName')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                                <input required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                    placeholder="your@email.com" type="email" value="{{ old('email') }}" name="email">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                                <input required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                    placeholder="+234 XXX XXX XXXX" type="tel" value="{{ old('phone') }}" name="phone">
                                @error('phone')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nationality *</label>
                                <input required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                    placeholder="Your nationality" type="text" value="{{ old('nationality') }}"
                                    name="nationality">
                                @error('nationality')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Destination Country *</label>
                                <input required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                    placeholder="Where are you traveling to?" type="text"
                                    value="{{ old('destinationCountry') }}" name="destinationCountry">
                                @error('destinationCountry')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Visa Type *</label>
                                <select name="visaType" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                                    <option value="">Select visa type</option>
                                    <option value="tourist" @selected(old('visaType') === 'tourist')>Tourist Visa</option>
                                    <option value="student" @selected(old('visaType') === 'student')>Student Visa</option>
                                    <option value="work" @selected(old('visaType') === 'work')>Work Visa</option>
                                    <option value="business" @selected(old('visaType') === 'business')>Business Visa</option>
                                    <option value="transit" @selected(old('visaType') === 'transit')>Transit Visa</option>
                                    <option value="other" @selected(old('visaType') === 'other')>Other</option>
                                </select>
                                @error('visaType')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Intended Travel Date *</label>
                            <input required min="{{ now()->addDay()->toDateString() }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                                type="date" value="{{ old('travelDate') }}" name="travelDate">
                            @error('travelDate')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Special Note or Questions</label>
                            <textarea name="specialNote" maxlength="500" rows="4"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm resize-none"
                                placeholder="Tell us about your specific situation or any questions you have...">{{ old('specialNote') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Maximum 500 characters</p>
                            @error('specialNote')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" data-submit-btn class="w-full cursor-pointer bg-blue-500 hover:bg-blue-600 text-white font-semibold py-4 px-8 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap">
                            Continue to Payment - ₦{{ number_format($consultationFee, 0) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            const visaForm = document.querySelector('form[action="{{ route('visa.consultation.store') }}"]');
            if (visaForm) {
                visaForm.addEventListener('submit', () => {
                    const button = visaForm.querySelector('[data-submit-btn]');
                    if (!button) return;
                    button.disabled = true;
                    button.innerHTML = '<span class="inline-flex items-center gap-2"><span class="w-4 h-4 border-2 border-white/40 border-t-white rounded-full animate-spin"></span>Submitting...</span>';
                });
            }
        </script>
    @endpush
@endsection
