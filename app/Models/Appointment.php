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
     * every day. Uses MAX(serial_number)+1 rather than counting rows, so a
     * cancelled appointment never leaves a "gap" that a later booking could
     * duplicate.
     */
    public static function nextSerialFor(int $doctorId, string $date): int
    {
        $max = static::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date)
            ->max('serial_number');

        return ((int) $max) + 1;
    }

    /**
     * Create an appointment with a guaranteed-unique serial number for the
     * doctor+date, even if two bookings arrive at the same instant. Locks
     * the existing rows for that doctor+date inside a transaction so two
     * concurrent requests can't both read the same MAX() and collide.
     */
    public static function createWithSerial(array $attributes): self
    {
        return \Illuminate\Support\Facades\DB::transaction(function () use ($attributes) {
            $max = static::where('doctor_id', $attributes['doctor_id'])
                ->whereDate('appointment_date', $attributes['appointment_date'])
                ->lockForUpdate()
                ->max('serial_number');

            $attributes['serial_number'] = ((int) $max) + 1;

            return static::create($attributes);
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
}
