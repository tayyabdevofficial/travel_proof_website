<x-layouts::app :title="__('Pricing')">
    <div class="px-4 sm:px-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                Pricing Settings
            </h1>
            <p class="text-sm text-gray-600">
                Update prices used on the booking form.
            </p>
        </div>

        @if (session('status'))
            <div
                class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700"
            >
                {{ session('status') }}
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.pricing.update') }}"
            class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm"
        >
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Flight Reservation Price</label
                    >
                    <input
                        type="number"
                        step="0.01"
                        name="flight_price"
                        value="{{ old('flight_price', $pricing->flight_price) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm"
                        required
                    />
                    @error('flight_price')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Hotel Confirmation Price</label
                    >
                    <input
                        type="number"
                        step="0.01"
                        name="hotel_price"
                        value="{{ old('hotel_price', $pricing->hotel_price) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm"
                        required
                    />
                    @error('hotel_price')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Combo Discount Percent</label
                    >
                    <input
                        type="number"
                        step="0.001"
                        name="combo_discount_percent"
                        value="{{ old('combo_discount_percent', $pricing->combo_discount_percent) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm"
                        required
                    />
                    @error('combo_discount_percent')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        >Visa Consultation Fee</label
                    >
                    <input
                        type="number"
                        step="0.01"
                        name="consultation_fee"
                        value="{{ old('consultation_fee', $pricing->consultation_fee) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm"
                        required
                    />
                    @error('consultation_fee')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button
                    type="submit"
                    class="bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold text-sm hover:bg-orange-700 transition-colors"
                >
                    Save Pricing
                </button>
            </div>
        </form>
    </div>
</x-layouts::app>
