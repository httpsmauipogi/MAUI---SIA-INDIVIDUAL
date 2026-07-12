<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'name',
        'specialization',
        'qualification',
        'phone',
        'email',
        'experience_years',
        'consultation_fee',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Doctor $doctor) {
            $doctor->updateQuietly([
                'doctor_id' => 'DR-' . str_pad((string) $doctor->id, 5, '0', STR_PAD_LEFT),
            ]);
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
