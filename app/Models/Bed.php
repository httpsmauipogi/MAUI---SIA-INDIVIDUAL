<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    use HasFactory;

    protected $fillable = [
        'bed_number',
        'ward',
        'floor',
        'status',
        'patient_id',
        'occupied_at',
    ];

    protected function casts(): array
    {
        return [
            'occupied_at' => 'datetime',
        ];
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function activeAdmission()
    {
        return $this->hasOne(Admission::class)->where('status', 'Admitted');
    }
}
