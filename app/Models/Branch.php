<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'phone',
        'email',
        'city',
        'address',
        'manager_name',
        'status',
        'is_main',
    ];

    protected function casts(): array
    {
        return [
            'is_main' => 'boolean',
        ];
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function staff()
    {
        return $this->hasMany(User::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }

    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

    /**
     * Staff members with the "Branch Admin" role assigned to this branch.
     */
    public function admins()
    {
        return $this->staff()->whereHas('roles', fn ($q) => $q->where('name', 'Branch Admin'));
    }
}
