<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_no',
        'patient_id',
        'doctor_id',
        'appointment_id',
        'prescription_date',
        'diagnosis',
        'medicines',
        'advice',
        'follow_up_date',
    ];

    protected function casts(): array
    {
        return [
            'medicines' => 'array',
            'prescription_date' => 'date',
            'follow_up_date' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Prescription $prescription) {
            $prescription->updateQuietly([
                'prescription_no' => 'RX-' . str_pad((string) $prescription->id, 5, '0', STR_PAD_LEFT),
            ]);
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
