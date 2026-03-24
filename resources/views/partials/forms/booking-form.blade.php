@props([
    'showTabs' => false,
    'activeTab' => 'flight',
    'comboSavings' => 0,
])

<form
    method="POST"
    action="{{ route('bookings.store') }}"
    class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden"
>
    @csrf
    @if ($showTabs)
        <div class="flex flex-col sm:flex-row border-b border-gray-200 sm:border-b-0" data-tabs>
            <button type="button" data-tab-trigger="flight"
                class="w-full sm:flex-1 px-4 sm:px-6 py-4 text-xs sm:text-sm font-semibold transition-all cursor-pointer text-blue-600 border-b-2 border-blue-600 bg-blue-50">
                <div class="flex items-center justify-center gap-2">
                    <img src="/images/icons/airplane.svg" alt="" class="w-4 h-4 sm:w-5 sm:h-5 icon-theme-blue"><span>Flight Reservation</span>
                </div>
            </button>
            <button type="button" data-tab-trigger="hotel"
                class="w-full sm:flex-1 px-4 sm:px-6 py-4 text-xs sm:text-sm font-semibold transition-all cursor-pointer border-b border-gray-200 text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                <div class="flex items-center justify-center gap-2">
                    <img src="/images/icons/hotel.svg" alt="" class="w-4 h-4 sm:w-5 sm:h-5 icon-theme-blue"><span>Hotel Booking</span>
                </div>
            </button>
            <button type="button" data-tab-trigger="combo"
                class="w-full sm:flex-1 px-4 sm:px-6 py-4 text-xs sm:text-sm font-semibold transition-all cursor-pointer relative border-b border-gray-200 text-gray-600 hover:text-gray-900 hover:bg-gray-50">
                <span
                    class="sm:absolute sm:top-2 sm:right-3 inline-flex bg-green-500 text-white px-2 py-0.5 rounded-full text-[9px] font-bold whitespace-nowrap mb-2 sm:mb-0">Save NGN {{ number_format($comboSavings, 0) }}</span>
                <div class="flex items-center justify-center gap-2">
                    <img src="/images/icons/combo.svg" alt="" class="w-6 h-6 sm:w-7 sm:h-7 icon-theme-blue"><span>Flight + Hotel</span>
                </div>
            </button>
        </div>
    @endif

    <input type="hidden" name="reservationType" value="{{ $activeTab }}" data-tab-input />

    <div class="p-8" data-tab-panel="flight">
        @if ($showTabs || in_array($activeTab, ['flight', 'combo'], true))
            <div class="mb-8 pb-8 border-b border-gray-200" id="flight-details" data-required-group="flight">
                <h3 class="text-xl font-bold text-gray-900 mb-4">
                    Flight Details
                </h3>
                <div class="mb-4">
                    <div class="inline-flex gap-2 bg-gray-100 rounded-lg p-1" data-trip-toggle>
                        <button type="button" data-trip-trigger="oneway"
                            class="px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap cursor-pointer text-sm bg-white text-blue-600 shadow-sm">
                            One Way
                        </button>
                        <button type="button" data-trip-trigger="roundtrip"
                            class="px-4 py-2 rounded-lg font-medium transition-all whitespace-nowrap cursor-pointer text-sm text-gray-700">
                            Round Trip (+50%)
                        </button>
                    </div>
                </div>
                <input type="hidden" name="trip_type" value="oneway" data-trip-input />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">From
                            <span class="text-red-500">*</span></label>
                        <input required autocomplete="off" data-airport-input="from"
                            class="form-input"
                            placeholder="Departure city" type="text" value="" name="from" />
                        <input type="hidden" name="fromCode" data-airport-code="from" />
                        <p data-airport-error="from" class="hidden mt-2 text-xs text-red-500">
                            Departure and arrival airports cannot be the same.
                        </p>
                        <div data-airport-dropdown="from"
                            class="absolute z-20 mt-2 w-full rounded-lg border border-gray-200 bg-white shadow-lg hidden max-h-64 overflow-auto text-sm">
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">To
                            <span class="text-red-500">*</span></label>
                        <input required autocomplete="off" data-airport-input="to"
                            class="form-input"
                            placeholder="Arrival city" type="text" value="" name="to" />
                        <input type="hidden" name="toCode" data-airport-code="to" />
                        <p data-airport-error="to" class="hidden mt-2 text-xs text-red-500">
                            Departure and arrival airports cannot be the same.
                        </p>
                        <div data-airport-dropdown="to"
                            class="absolute z-20 mt-2 w-full rounded-lg border border-gray-200 bg-white shadow-lg hidden max-h-64 overflow-auto text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Departure Date
                            <span class="text-red-500">*</span></label>
                        <input required
                            class="form-input"
                            type="date" value="" name="departureDate" />
                    </div>
                    <div id="return-date-group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Return Date
                            <span class="text-red-500">*</span></label>
                        <input required
                            class="form-input"
                            type="date" value="" name="returnDate" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Passengers
                            <span class="text-red-500">*</span></label>
                        <select name="passengers_count" id="passengers-count" required
                            class="form-select cursor-pointer">
                            <option value="1">1 Passenger</option>
                            <option value="2">2 Passengers</option>
                            <option value="3">3 Passengers</option>
                            <option value="4">4 Passengers</option>
                            <option value="5">5 Passengers</option>
                            <option value="6">6 Passengers</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6" id="passenger-info">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">
                        Passenger Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" data-contact-group="flight">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address
                                <span class="text-red-500">*</span></label>
                            <input data-contact-input="flight" required
                                class="form-input"
                                placeholder="your@email.com" type="email" value="" name="email" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number
                                <span class="text-red-500">*</span></label>
                            <input data-contact-input="flight" required
                                class="form-input"
                                placeholder="+234 XXX XXX XXXX" type="tel" value="" name="phone" />
                        </div>
                    </div>
                    <div class="space-y-4" data-passenger-list></div>
                </div>
            </div>
        @endif

        @if ($showTabs || in_array($activeTab, ['hotel', 'combo'], true))
            <div class="mb-8 pb-8 border-b border-gray-200" id="hotel-details" data-required-group="hotel">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Hotel Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Destination
                            <span class="text-red-500">*</span></label>
                        <input required autocomplete="off" data-destination-input
                            class="form-input"
                            placeholder="Select destination" type="text" value="" name="hotelDestination" />
                        <div data-destination-dropdown
                            class="absolute z-20 mt-2 w-full rounded-lg border border-gray-200 bg-white shadow-lg hidden max-h-64 overflow-auto text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check-in Date
                            <span class="text-red-500">*</span></label>
                        <input required min="{{ now()->addDay()->toDateString() }}"
                            class="form-input"
                            type="date" value="" name="hotelCheckIn">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Check-out Date
                            <span class="text-red-500">*</span></label>
                        <input required min="{{ now()->addDay()->toDateString() }}"
                            class="form-input"
                            type="date" value="" name="hotelCheckOut">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number of Guests
                            <span class="text-red-500">*</span></label>
                        <select name="guests_count" id="guests-count" required
                            class="form-select cursor-pointer">
                            <option value="1">1 Guest</option>
                            <option value="2">2 Guests</option>
                            <option value="3">3 Guests</option>
                            <option value="4">4 Guests</option>
                            <option value="5">5 Guests</option>
                            <option value="6">6 Guests</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6" id="guest-info">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">
                        Guest Information
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" data-contact-group="hotel">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address
                                <span class="text-red-500">*</span></label>
                            <input data-contact-input="hotel" required
                                class="form-input"
                                placeholder="your@email.com" type="email" value="" name="email" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number
                                <span class="text-red-500">*</span></label>
                            <input data-contact-input="hotel" required
                                class="form-input"
                                placeholder="+234 XXX XXX XXXX" type="tel" value="" name="phone" />
                        </div>
                    </div>
                    <div class="space-y-4" data-guest-list></div>
                </div>
            </div>
        @endif

        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Special Note
                (Optional)</label>
            <textarea name="specialNote" maxlength="500" rows="4"
                class="form-textarea resize-none"
                placeholder="Any special requests or additional information. Note cannot be guaranteed."></textarea>
            <p class="text-xs text-gray-500 mt-1">
                Maximum 500 characters
            </p>
        </div>

        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Receive Later <span
                        class="text-red-500">*</span></label>
                <select name="receive_timing" data-receive-timing
                    class="form-select cursor-pointer">
                    <option value="now" selected>I need it now</option>
                    <option value="later">I want to receive it later</option>
                </select>
            </div>
            <div class="hidden" data-receive-date>
                <label class="block text-sm font-medium text-gray-700 mb-2">Delivery Date
                    <span class="text-red-500">*</span></label>
                <input
                    class="form-input"
                    type="date" value="" name="receive_date" />
            </div>
        </div>

        <div class="pt-6 border-t border-gray-200">
            <div class="hidden" data-total-amount data-price-flight="{{ $flightPrice }}"
                data-price-hotel="{{ $hotelPrice }}" data-discount="{{ $discountPercent }}">
                <span data-total-final>NGN {{ number_format($flightPrice, 0) }}</span>
                <span data-total-base class="ml-2 text-sm text-gray-400 line-through hidden">NGN
                    {{ number_format($comboBase, 0) }}</span>
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg font-bold hover:bg-blue-700 transition-all hover:scale-[1.02] whitespace-nowrap cursor-pointer flex items-center justify-center gap-2"
                data-total-button>
                <span data-total-label>Continue to Payment - NGN {{ number_format($flightPrice, 0) }}</span>
                <img src="/images/icons/arrow-right.svg" alt="" class="w-4 h-4 brightness-0 invert">
            </button>
            <div class="mt-3 flex items-center justify-center gap-2 text-xs text-gray-500 text-center">
                <img src="/images/icons/lock.svg" alt="Secure" class="w-4 h-4 mt-0.5">
                <span>All payments are secure and encrypted. We accept bank transfers, cards, and Mobile money.</span>
            </div>
        </div>
    </div>
</form>
