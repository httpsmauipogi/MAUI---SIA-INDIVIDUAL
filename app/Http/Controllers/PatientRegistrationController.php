<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('Patient');

        // Link to an existing patient record (matched by phone) if the hospital
        // already has one on file, otherwise create a fresh patient record.
        $patient = Patient::firstOrNew(['phone' => $validated['phone']]);
        $patient->fill([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'gender' => $validated['gender'],
            'date_of_birth' => $validated['date_of_birth'] ?? $patient->date_of_birth,
            'status' => 'Active',
        ]);
        $patient->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('patient.dashboard')->with('status', 'Welcome to Healix HMS! Your patient account has been created.');
    }
}
