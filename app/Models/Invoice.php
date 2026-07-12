<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'patient_id',
        'appointment_id',
        'items',
        'subtotal',
        'discount',
        'total',
        'paid_amount',
        'status',
        'invoice_date',
        'due_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'items' => 'array',
            'subtotal' => 'decimal:2',
            'discount' => 'decimal:2',
            'total' => 'decimal:2',
            'paid_amount' => 'decimal:2',
            'invoice_date' => 'date',
            'due_date' => 'date',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (Invoice $invoice) {
            $invoice->updateQuietly([
                'invoice_no' => 'INV-' . str_pad((string) $invoice->id, 5, '0', STR_PAD_LEFT),
            ]);
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function getDueAmountAttribute(): float
    {
        return round((float) $this->total - (float) $this->paid_amount, 2);
    }

    public function refreshStatus(): void
    {
        $due = $this->due_amount;

        if ($due <= 0) {
            $status = 'Paid';
        } elseif ((float) $this->paid_amount > 0) {
            $status = 'Partial';
        } else {
            $status = 'Unpaid';
        }

        $this->updateQuietly(['status' => $status]);
    }
}
