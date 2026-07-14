<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_no',
        'patient_id',
        'doctor_id',
        'bed_id',
        'admission_date',
        'expected_discharge_date',
        'discharge_date',
        'reason',
        'diagnosis',
        'status',
        'discharge_notes',
        'admitted_by',
    ];

    protected function casts(): array
    {
        return [
            'admission_date' => 'datetime',
            'expected_discharge_date' => 'date',
            'discharge_date' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Admission $admission) {
            $admission->updateQuietly([
                'admission_no' => 'IPD-' . str_pad((string) $admission->id, 5, '0', STR_PAD_LEFT),
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

    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }

    public function admittedBy()
    {
        return $this->belongsTo(User::class, 'admitted_by');
    }

    public function lengthOfStay(): int
    {
        $end = $this->discharge_date ?? now();

        return (int) $this->admission_date->diffInDays($end) + 1;
    }
}
