<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BedController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\DutyLogController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\LabOrderController;
use App\Http\Controllers\Admin\LabTestController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PrescriptionController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// Authentication (login, register, password reset, logout) is handled by
// Laravel Breeze - see routes/auth.php. This file only holds Healix HMS
// admin panel pages.
//
// Every module below is wrapped in a role:... middleware matching exactly
// who can see it in the sidebar (partials/backend/sidebar.blade.php), so a
// role can't bypass the hidden menu item by typing the URL directly.

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/lock-screen', [AdminController::class, 'showLockScreen'])->name('lock-screen');

    Route::middleware(['auth', 'role:Super Admin|Hospital Admin|Doctor|Nurse|Ward Boy|Cleaner|Receptionist|Pharmacist|Lab Technician|Accountant'])->group(function () {

        // Dashboard - every staff role lands here, AdminController decides
        // which dashboard view to show based on the user's role.
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/', [AdminController::class, 'dashboard'])->name('home');

        // Patients - front-desk + clinical roles
        Route::middleware('role:Super Admin|Hospital Admin|Receptionist|Doctor')->group(function () {
            Route::resource('patients', PatientController::class);
        });

        // Doctors directory management - admin roles only
        Route::middleware('role:Super Admin|Hospital Admin')->group(function () {
            Route::resource('doctors', DoctorController::class);
        });

        // Doctor-facing "my patients" view
        Route::middleware('role:Doctor')->group(function () {
            Route::get('my-patients', [DoctorController::class, 'myPatients'])->name('my-patients');
        });

        // Appointments - front-desk + clinical roles
        Route::middleware('role:Super Admin|Hospital Admin|Receptionist|Doctor')->group(function () {
            Route::resource('appointments', AppointmentController::class);
        });

        // Prescriptions - doctors write them, pharmacists dispense against them
        Route::middleware('role:Super Admin|Hospital Admin|Doctor|Pharmacist')->group(function () {
            Route::resource('prescriptions', PrescriptionController::class);
        });

        // Billing - accounts + front-desk
        Route::middleware('role:Super Admin|Hospital Admin|Accountant|Receptionist')->group(function () {
            Route::resource('invoices', InvoiceController::class);
            Route::post('invoices/{invoice}/payment', [InvoiceController::class, 'recordPayment'])->name('invoices.payment');
        });

        // Contact form messages - front-desk facing
        Route::middleware('role:Super Admin|Hospital Admin|Receptionist')->group(function () {
            Route::resource('messages', ContactMessageController::class)->except(['create', 'store', 'edit', 'update']);
        });

        // Bed / ward management - real-time availability board
        Route::middleware('role:Super Admin|Hospital Admin|Receptionist|Nurse|Ward Boy')->group(function () {
            Route::resource('beds', BedController::class);
            Route::post('beds/{bed}/assign', [BedController::class, 'assign'])->name('beds.assign');
            Route::post('beds/{bed}/discharge', [BedController::class, 'discharge'])->name('beds.discharge');
        });

        // Staff duty / task tracking board (nurses, ward boys, cleaners, etc.)
        Route::middleware('role:Super Admin|Hospital Admin|Nurse|Ward Boy|Cleaner')->group(function () {
            Route::resource('duty-logs', DutyLogController::class)->except(['show']);
            Route::post('duty-logs/{dutyLog}/complete', [DutyLogController::class, 'complete'])->name('duty-logs.complete');
        });

        // Pharmacy - medicine inventory with restock/dispense stock tracking
        Route::middleware('role:Super Admin|Hospital Admin|Pharmacist')->group(function () {
            Route::resource('pharmacy', MedicineController::class);
            Route::post('pharmacy/{medicine}/restock', [MedicineController::class, 'restock'])->name('pharmacy.restock');
            Route::post('pharmacy/{medicine}/dispense', [MedicineController::class, 'dispense'])->name('pharmacy.dispense');
        });

        // Laboratory - test catalog + patient test orders with results
        Route::middleware('role:Super Admin|Hospital Admin|Lab Technician')->group(function () {
            Route::resource('lab-tests', LabTestController::class)->except(['show']);
            Route::resource('lab-orders', LabOrderController::class);
        });

        // Staff / user account management - restricted to admin roles only
        Route::middleware('role:Super Admin|Hospital Admin')->group(function () {
            Route::resource('users', UserController::class);
            Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
        });

        // In-app notification center - available to every authenticated staff role
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('notifications/{id}/read', [NotificationController::class, 'read'])->name('notifications.read');
        Route::post('notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read-all');
        Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

        // Full website customization - Super Admin only
        Route::middleware('role:Super Admin')->group(function () {
            Route::get('settings/website', [SiteSettingController::class, 'edit'])->name('settings.website');
            Route::put('settings/website', [SiteSettingController::class, 'update'])->name('settings.website.update');

            // Per-page banner + repeatable card content management (CMS)
            Route::get('page-content', [PageContentController::class, 'index'])->name('page-content.index');
            Route::get('page-content/{pageKey}', [PageContentController::class, 'edit'])->name('page-content.edit');
            Route::put('page-content/{pageKey}/banner', [PageContentController::class, 'updateBanner'])->name('page-content.banner.update');
            Route::post('page-content/{pageKey}/cards', [PageContentController::class, 'storeCard'])->name('page-content.cards.store');
            Route::put('page-content/cards/{card}', [PageContentController::class, 'updateCard'])->name('page-content.cards.update');
            Route::delete('page-content/cards/{card}', [PageContentController::class, 'destroyCard'])->name('page-content.cards.destroy');
            Route::post('page-content/cards/{card}/move', [PageContentController::class, 'moveCard'])->name('page-content.cards.move');
        });
    });
});
