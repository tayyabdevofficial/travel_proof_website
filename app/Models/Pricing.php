<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_price',
        'hotel_price',
        'combo_discount_percent',
        'consultation_fee',
    ];

    protected function casts(): array
    {
        return [
            'flight_price' => 'decimal:2',
            'hotel_price' => 'decimal:2',
            'combo_discount_percent' => 'decimal:3',
            'consultation_fee' => 'decimal:2',
        ];
    }
}
