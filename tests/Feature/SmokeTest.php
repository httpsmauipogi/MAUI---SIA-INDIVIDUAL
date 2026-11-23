<?php

namespace Tests\Feature;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_pharmacy_binding_and_patient_branch_default(): void
    {
        $branch = Branch::create(['name' => 'Main Branch', 'code' => 'MAIN', 'is_main' => true]);
        Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $medicine = Medicine::create([
            'name' => 'Paracetamol',
            'unit' => 'Tablet',
            'stock_quantity' => 100,
            'reorder_level' => 10,
            'unit_price' => 1.5,
            'branch_id' => $branch->id,
        ]);

        $this->actingAs($admin)->get(route('admin.pharmacy.show', $medicine))->assertOk();
        $this->actingAs($admin)->get(route('admin.pharmacy.edit', $medicine))->assertOk();

        $this->actingAs($admin)->post(route('admin.patients.store'), [
            'name' => 'Jane Doe',
            'gender' => 'Female',
            'phone' => '1234567890',
        ])->assertRedirect(route('admin.patients.index'));

        $this->assertDatabaseHas('patients', [
            'name' => 'Jane Doe',
            'branch_id' => $branch->id,
        ]);
    }

    public function test_appointment_confirmation_requires_a_signed_url(): void
    {
        $branch = Branch::create(['name' => 'Main Branch', 'is_main' => true]);
        $doctor = Doctor::create(['name' => 'Dr Who', 'specialization' => 'GP', 'branch_id' => $branch->id]);
        $patient = Patient::create(['name' => 'John Doe', 'gender' => 'Male', 'phone' => '111', 'branch_id' => $branch->id]);
        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'appointment_date' => now()->addDay(),
            'appointment_time' => '10:00:00',
        ]);

        $signed = URL::temporarySignedRoute(
            'frontend.appointment.confirmation',
            now()->addMinutes(30),
            ['appointment' => $appointment->id]
        );

        $this->get($signed)->assertOk();
        $this->get('/appointment/confirmation/'.$appointment->id)->assertForbidden();
    }
}
