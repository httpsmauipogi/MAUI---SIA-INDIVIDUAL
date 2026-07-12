<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineStockLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'medicine_id',
        'type',
        'quantity',
        'patient_id',
        'prescription_id',
        'user_id',
        'notes',
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
