<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        Branch::firstOrCreate(
            ['name' => 'Main Branch'],
            ['status' => 'Active', 'is_main' => true]
        );

        // Import any branch names already typed into doctor records so
        // existing data isn't orphaned once Branches becomes a real module.
        Doctor::whereNotNull('branch')
            ->distinct()
            ->pluck('branch')
            ->filter()
            ->each(function (string $name) {
                Branch::firstOrCreate(['name' => $name], ['status' => 'Active']);
            });
    }
}
