<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'name',
        'generic_name',
        'category',
        'unit',
        'manufacturer',
        'stock_quantity',
        'reorder_level',
        'unit_price',
        'expiry_date',
        'status',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected function casts(): array
    {
        return [
            'expiry_date' => 'date',
        ];
    }

    public function stockLogs()
    {
        return $this->hasMany(MedicineStockLog::class);
    }

    public function isLowStock(): bool
    {
        return $this->stock_quantity <= $this->reorder_level;
    }

    public function isExpiringSoon(): bool
    {
        return $this->expiry_date && $this->expiry_date->lessThanOrEqualTo(now()->addDays(30));
    }
}
