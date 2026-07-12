<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'patient_id',
        'doctor_id',
        'lab_test_id',
        'price',
        'status',
        'ordered_date',
        'sample_collected_at',
        'result_date',
        'result_notes',
        'result_file',
    ];

    protected function casts(): array
    {
        return [
            'ordered_date' => 'date',
            'sample_collected_at' => 'datetime',
            'result_date' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (LabOrder $order) {
            $order->updateQuietly([
                'order_no' => 'LAB-' . str_pad((string) $order->id, 5, '0', STR_PAD_LEFT),
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

    public function labTest()
    {
        return $this->belongsTo(LabTest::class);
    }
}
