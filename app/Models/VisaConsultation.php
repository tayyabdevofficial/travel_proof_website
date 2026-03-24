<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'full_name',
        'email',
        'phone',
        'nationality',
        'destination_country',
        'visa_type',
        'travel_date',
        'special_note',
        'consultation_fee',
        'payment_method',
        'payment_provider',
        'payment_reference',
        'payment_currency',
        'payment_meta',
        'payment_status',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'travel_date' => 'date',
            'consultation_fee' => 'decimal:2',
            'payment_meta' => 'array',
            'paid_at' => 'datetime',
        ];
    }

    public function replies()
    {
        return $this->hasMany(VisaConsultationReply::class);
    }
}
