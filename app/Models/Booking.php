<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'booking_type',
        'full_name',
        'email',
        'phone',
        'flight_details',
        'hotel_details',
        'passengers',
        'guests',
        'special_note',
        'receive_timing',
        'receive_date',
        'flight_price',
        'hotel_price',
        'discount_percent',
        'total_amount',
        'payment_method',
        'payment_provider',
        'payment_reference',
        'payment_currency',
        'payment_meta',
        'paid_at',
        'payment_status',
        'status',
        'admin_notes',
    ];

    protected function casts(): array
    {
        return [
            'flight_details' => 'array',
            'hotel_details' => 'array',
            'passengers' => 'array',
            'guests' => 'array',
            'receive_date' => 'date',
            'flight_price' => 'decimal:2',
            'hotel_price' => 'decimal:2',
            'discount_percent' => 'decimal:3',
            'total_amount' => 'decimal:2',
            'payment_meta' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    public function updates()
    {
        return $this->hasMany(BookingUpdate::class);
    }
}
