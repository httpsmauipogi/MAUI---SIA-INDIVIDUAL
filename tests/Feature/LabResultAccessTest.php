<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\LabOrder;
use App\Models\LabTest;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class LabResultAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('private');
        Role::firstOrCreate(['name' => 'Patient', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'Lab Technician', 'guard_name' => 'web']);
    }

    public function test_lab_results_require_authentication(): void
    {
        $order = $this->labOrder();

        $this->get(route('lab-results.show', $order))->assertRedirect(route('login'));
    }

    public function test_patients_cannot_download_lab_results(): void
    {
        $order = $this->labOrder();
        $patientUser = User::factory()->create();
        $patientUser->assignRole('Patient');

        $this->actingAs($patientUser)
            ->get(route('lab-results.show', $order))
            ->assertForbidden();
    }

    public function test_lab_technicians_can_download_lab_results_from_private_disk(): void
    {
        Storage::disk('private')->put('lab-results/report.txt', 'private report body');

        $order = $this->labOrder(['result_file' => 'lab-results/report.txt']);
        $technician = User::factory()->create();
        $technician->assignRole('Lab Technician');

        $response = $this->actingAs($technician)
            ->get(route('lab-results.show', $order))
            ->assertOk();

        $this->assertStringContainsString('private report body', $response->streamedContent());
    }

    private function labOrder(array $attributes = []): LabOrder
    {
        $branch = Branch::create(['name' => 'Main', 'code' => 'MAIN', 'is_main' => true]);
        $patient = Patient::create([
            'name' => 'Jane Doe',
            'gender' => 'Female',
            'phone' => '1234567890',
            'branch_id' => $branch->id,
        ]);
        $test = LabTest::create(['name' => 'Blood Count']);

        return LabOrder::create(array_merge([
            'patient_id' => $patient->id,
            'lab_test_id' => $test->id,
            'ordered_date' => now(),
            'status' => 'Completed',
        ], $attributes));
    }
}
