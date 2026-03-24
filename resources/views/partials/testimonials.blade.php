@props([
    'title' => 'Success Stories',
    'subtitle' => 'Hear from travelers who got their visas approved',
    'columns' => 'md:grid-cols-3',
    'class' => '',
])

<section class="py-16 bg-white {{ $class }}">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                {{ $title }}
            </h2>
            <p class="text-base text-gray-600">
                {{ $subtitle }}
            </p>
        </div>
        <div class="grid grid-cols-1 {{ $columns }} gap-6">
            <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-gray-200">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/testimonials/1.jpg') }}" alt="Chioma Okafor" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Chioma Okafor</div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex gap-1">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                            </div>
                            <span class="text-xs font-semibold text-gray-500">| Rated 5.0</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-700 text-sm italic mb-4">
                    "I was skeptical at first, but the documents were perfect! The embassy accepted everything without
                    a single question. Got my UK visa approved in 3 weeks. This service saved me so much stress and
                    money!"
                </p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-gray-200">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/testimonials/2.jpg') }}" alt="Adebayo Williams" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Adebayo Williams</div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex gap-1">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                            </div>
                            <span class="text-xs font-semibold text-gray-500">| Rated 5.0</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-700 text-sm italic mb-4">
                    "Fast, reliable, and professional! I received my flight reservation in 20 minutes with a valid PNR
                    that I verified myself. The embassy had no issues. Worth every naira. Highly recommend to anyone
                    applying for Schengen visa!"
                </p>
            </div>
            <div class="bg-gray-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition-all border border-gray-200">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/testimonials/3.jpg') }}" alt="Fatima Abdullahi" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Fatima Abdullahi</div>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="flex gap-1">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                                <img src="/images/icons/star.svg" alt="" class="w-5 h-5">
                            </div>
                            <span class="text-xs font-semibold text-gray-500">| Rated 5.0</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-700 text-sm italic mb-4">
                    "Best decision I made for my visa application! The combo package gave me both flight and hotel
                    documents at an amazing price. Customer support was excellent and answered all my questions. My
                    Canada visa was approved on first attempt!"
                </p>
            </div>
        </div>
    </div>
</section>
