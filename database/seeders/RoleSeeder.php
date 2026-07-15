<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Super Admin',
            'Hospital Admin',
            'Branch Admin',
            'Doctor',
            'Receptionist',
            'Nurse',
            'Ward Boy',
            'Cleaner',
            'Pharmacist',
            'Lab Technician',
            'Accountant',
            'Patient',
        ];
        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }
    }
}
