<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'max_patients',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function formattedTime(): string
    {
        return \Carbon\Carbon::parse($this->start_time)->format('h:i A')
            . ' - ' . \Carbon\Carbon::parse($this->end_time)->format('h:i A');
    }
}
