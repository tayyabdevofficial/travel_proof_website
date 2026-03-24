<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_provider')->nullable()->after('payment_method');
            $table->string('payment_reference')->nullable()->after('payment_provider');
            $table->string('payment_currency', 10)->nullable()->after('payment_reference');
            $table->json('payment_meta')->nullable()->after('payment_currency');
            $table->timestamp('paid_at')->nullable()->after('payment_meta');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_provider', 'payment_reference', 'payment_currency', 'payment_meta', 'paid_at']);
        });
    }
};
