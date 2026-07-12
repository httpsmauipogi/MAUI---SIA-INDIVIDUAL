<?php

use App\Http\Controllers\Patient\PatientPortalController;
use App\Http\Controllers\PatientRegistrationController;
use Illuminate\Support\Facades\Route;

// Public patient self-registration (creates a User + links/creates a Patient record)
Route::middleware('maintenance')->group(function () {
    Route::get('/patient/register', [PatientRegistrationController::class, 'create'])->name('patient.register');
    Route::post('/patient/register', [PatientRegistrationController::class, 'store'])->name('patient.register.store');
});

// Patient portal - strictly scoped to the logged-in patient's own records
Route::prefix('patient')->name('patient.')->middleware(['auth', 'role:Patient'])->group(function () {
    Route::get('/dashboard', [PatientPortalController::class, 'dashboard'])->name('dashboard');

    Route::get('/appointments', [PatientPortalController::class, 'appointments'])->name('appointments');

    Route::get('/prescriptions', [PatientPortalController::class, 'prescriptions'])->name('prescriptions');
    Route::get('/prescriptions/{prescription}', [PatientPortalController::class, 'prescriptionShow'])->name('prescriptions.show');

    Route::get('/invoices', [PatientPortalController::class, 'invoices'])->name('invoices');
    Route::get('/invoices/{invoice}', [PatientPortalController::class, 'invoiceShow'])->name('invoices.show');

    Route::get('/profile', [PatientPortalController::class, 'editProfile'])->name('profile');
    Route::put('/profile', [PatientPortalController::class, 'updateProfile'])->name('profile.update');
});
