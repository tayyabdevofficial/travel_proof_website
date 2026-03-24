<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pricing;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function edit()
    {
        $pricing = Pricing::firstOrCreate([], [
            'flight_price' => 5000,
            'hotel_price' => 4000,
            'combo_discount_percent' => 22.22,
            'consultation_fee' => 50000,
        ]);

        return view('admin.pricing', compact('pricing'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'flight_price' => ['required', 'numeric', 'min:0'],
            'hotel_price' => ['required', 'numeric', 'min:0'],
            'combo_discount_percent' => ['required', 'numeric', 'min:0', 'max:100'],
            'consultation_fee' => ['required', 'numeric', 'min:0'],
        ]);

        $pricing = Pricing::firstOrCreate([], [
            'flight_price' => 5000,
            'hotel_price' => 4000,
            'combo_discount_percent' => 22.22,
            'consultation_fee' => 50000,
        ]);

        $pricing->update($validated);

        return redirect()
            ->route('admin.pricing.edit')
            ->with('status', 'Pricing updated.');
    }
}
