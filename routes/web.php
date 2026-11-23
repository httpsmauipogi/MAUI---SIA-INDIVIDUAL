<?php

use App\Http\Controllers\LabResultController;

require __DIR__.'/frontend.php';
require __DIR__.'/admin.php';
require __DIR__.'/patient.php';
require __DIR__.'/profile.php';
require __DIR__.'/auth.php';

// Lab results live on the private disk; only staff may download them.
Route::get('/lab-results/{labOrder}', [LabResultController::class, 'show'])
    ->middleware(['auth', 'role:Super Admin|Hospital Admin|Branch Admin|Doctor|Lab Technician'])
    ->name('lab-results.show');

// Breeze's auth flows (login, registration, email verification, password
// confirmation) all redirect to a route named "dashboard". The HMS keeps its
// role-specific dashboards, so resolve the generic name to the right one here
// instead of leaving those flows pointing at a route that doesn't exist.
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    $staffRoles = ['Super Admin', 'Hospital Admin', 'Branch Admin', 'Doctor', 'Nurse', 'Ward Boy', 'Cleaner', 'Receptionist', 'Pharmacist', 'Lab Technician', 'Accountant'];

    if ($user->hasRole('Patient') && ! $user->hasAnyRole($staffRoles)) {
        return redirect()->route('patient.dashboard');
    }

    if ($user->hasAnyRole($staffRoles)) {
        return redirect()->route('admin.dashboard');
    }

    return redirect('/');
})->name('dashboard');
