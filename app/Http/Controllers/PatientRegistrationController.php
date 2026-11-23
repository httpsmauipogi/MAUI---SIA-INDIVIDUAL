<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PatientRegistrationController extends Controller
{
    public function create()
    {
        return view('frontend.patient-register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'date_of_birth' => ['nullable', 'date'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Older deployments may never have run RoleSeeder, which made every
        // registration fail with "There is no role named `Patient`". Create it
        // on demand so a fresh install can register patients out of the box.
        $patientRole = Role::firstOrCreate([
            'name' => 'Patient',
            'guard_name' => 'web',
        ]);

        // Keep the user, role and patient record atomic: a failure must not
        // leave a half-registered account behind.
        $user = DB::transaction(function () use ($validated, $patientRole) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->assignRole($patientRole);

            // Never bind a new account to an existing record by phone alone;
            // knowing somebody's phone must not expose their portal data.
            $patient = $user->patient ?? new Patient();

            $patient->fill([
                'user_id' => $user->id,
                'branch_id' => $patient->branch_id ?? $this->defaultBranchId(),
                'name' => $validated['name'],
                'email' => $validated['email'],
                'gender' => $validated['gender'],
                'date_of_birth' => $validated['date_of_birth'] ?? $patient->date_of_birth,
                'status' => 'Active',
            ]);
            $patient->save();

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('patient.dashboard')->with('status', 'Welcome to Healix HMS! Your patient account has been created.');
    }
}
