<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaConsultationReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_consultation_id',
        'admin_id',
        'message',
        'attachments',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
        ];
    }

    public function consultation()
    {
        return $this->belongsTo(VisaConsultation::class, 'visa_consultation_id');
    }
}
