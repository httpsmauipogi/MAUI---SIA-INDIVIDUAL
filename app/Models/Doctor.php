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
        'photo',
        'specialization',
        'qualification',
        'phone',
        'email',
        'experience_years',
        'consultation_fee',
        'branch',
        'branch_id',
        'floor',
        'room_no',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class)->orderByRaw(
            "FIELD(day_of_week, 'Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday')"
        );
    }

    public function photoUrl(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('frontend/images/doctor-' . (($this->id % 6) + 1) . '.jpg');
    }

    /**
     * Whether this doctor has a schedule slot on the given day name (e.g. "Monday").
     */
    public function isAvailableOn(string $dayName): bool
    {
        return $this->schedules->contains(fn ($s) => $s->day_of_week === $dayName);
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
