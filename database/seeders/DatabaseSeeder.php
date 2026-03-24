<?php

namespace Database\Seeders;

use App\Models\Pricing;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'password' => Hash::make('Admin@123'),
            'is_admin' => true,
        ]);

        Pricing::firstOrCreate([], [
            'flight_price' => 5000,
            'hotel_price' => 4000,
            'combo_discount_percent' => 22.22,
        ]);
    }
}
