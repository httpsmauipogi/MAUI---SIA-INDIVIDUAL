<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'category',
        'description',
        'amount',
        'expense_date',
        'paid_to',
        'notes',
        'recorded_by',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected function casts(): array
    {
        return [
            'expense_date' => 'date',
        ];
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    public const CATEGORIES = [
        'Salaries', 'Utilities', 'Medicine Purchase', 'Equipment', 'Maintenance',
        'Rent', 'Supplies', 'Marketing', 'Insurance', 'Other',
    ];
}
