<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'sample_type',
        'price',
        'description',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(LabOrder::class);
    }
}
