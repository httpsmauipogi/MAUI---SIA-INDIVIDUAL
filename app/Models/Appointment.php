<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_no',
        'patient_id',
        'doctor_id',
        'appointment_date',
        'appointment_time',
        'serial_number',
        'reason',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Appointment $appointment) {
            $appointment->updateQuietly([
                'appointment_no' => 'APT-' . str_pad((string) $appointment->id, 5, '0', STR_PAD_LEFT),
            ]);
        });
    }

    /**
     * The next serial number for this doctor on this date - resets to 1
     * every day since it only counts appointments on that exact date.
     */
    public static function nextSerialFor(int $doctorId, string $date): int
    {
        $count = static::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date)
            ->where('status', '!=', 'Cancelled')
            ->count();

        return $count + 1;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
