<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visa_consultations', function (Blueprint $table) {
            $table->string('tracking_id')->nullable()->unique()->after('id');
            $table->decimal('consultation_fee', 10, 2)->default(0)->after('special_note');
            $table->string('payment_method')->nullable()->after('consultation_fee');
            $table->string('payment_provider')->nullable()->after('payment_method');
            $table->string('payment_reference')->nullable()->after('payment_provider');
            $table->string('payment_currency', 10)->nullable()->after('payment_reference');
            $table->json('payment_meta')->nullable()->after('payment_currency');
            $table->string('payment_status')->default('pending')->after('payment_meta');
            $table->timestamp('paid_at')->nullable()->after('payment_status');
        });
    }

    public function down(): void
    {
        Schema::table('visa_consultations', function (Blueprint $table) {
            $table->dropColumn([
                'tracking_id',
                'consultation_fee',
                'payment_method',
                'payment_provider',
                'payment_reference',
                'payment_currency',
                'payment_meta',
                'payment_status',
                'paid_at',
            ]);
        });
    }
};
