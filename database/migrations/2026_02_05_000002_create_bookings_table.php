<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id')->unique();
            $table->string('booking_type'); // flight, hotel, combo
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->json('flight_details')->nullable();
            $table->json('hotel_details')->nullable();
            $table->json('passengers')->nullable();
            $table->json('guests')->nullable();
            $table->text('special_note')->nullable();
            $table->decimal('flight_price', 10, 2)->default(0);
            $table->decimal('hotel_price', 10, 2)->default(0);
            $table->decimal('discount_percent', 5, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
