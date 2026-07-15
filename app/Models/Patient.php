<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'branch_id',
        'patient_id',
        'name',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'blood_group',
        'address',
        'guardian_name',
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

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Patient $patient) {
            $patient->updateQuietly([
                'patient_id' => 'PT-' . str_pad((string) $patient->id, 5, '0', STR_PAD_LEFT),
            ]);
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function labOrders()
    {
        return $this->hasMany(LabOrder::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }
}
