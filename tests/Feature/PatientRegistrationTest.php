<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PatientRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_works_even_if_the_patient_role_was_never_seeded(): void
    {
        $this->assertDatabaseMissing('roles', ['name' => 'Patient']);

        $response = $this->post(route('patient.register.store'), [
            'name' => 'New Patient',
            'email' => 'new.patient@example.com',
            'phone' => '1234567890',
            'gender' => 'Female',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('patient.dashboard'));
        $this->assertDatabaseHas('roles', ['name' => 'Patient', 'guard_name' => 'web']);

        $user = User::where('email', 'new.patient@example.com')->firstOrFail();
        $this->assertTrue($user->hasRole('Patient'));
        $this->assertDatabaseHas('patients', [
            'user_id' => $user->id,
            'email' => 'new.patient@example.com',
            'status' => 'Active',
        ]);
    }
}
