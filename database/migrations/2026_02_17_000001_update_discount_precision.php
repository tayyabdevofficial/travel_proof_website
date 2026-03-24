<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pricings', function (Blueprint $table) {
            $table->decimal('combo_discount_percent', 6, 3)->default(0)->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('discount_percent', 6, 3)->default(0)->change();
        });
    }

    public function down(): void
    {
        Schema::table('pricings', function (Blueprint $table) {
            $table->decimal('combo_discount_percent', 5, 2)->default(0)->change();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('discount_percent', 5, 2)->default(0)->change();
        });
    }
};
