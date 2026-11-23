<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::middleware('maintenance')->group(function () {

    Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
    Route::get('/about-us', [FrontendController::class, 'about'])->name('frontend.about');
    Route::get('/who-we-are', [FrontendController::class, 'whoWeAre'])->name('frontend.who-we-are');
    Route::get('/services', [FrontendController::class, 'services'])->name('frontend.services');
    Route::get('/departments', [FrontendController::class, 'departments'])->name('frontend.departments');
    Route::get('/departments/{slug?}', [FrontendController::class, 'departmentSingle'])->name('frontend.department-single');
    Route::get('/doctors', [FrontendController::class, 'doctors'])->name('frontend.doctors');
    Route::get('/doctors/profile/{doctor}', [FrontendController::class, 'doctorShow'])->name('frontend.doctor.show');
    Route::get('/doctors/{doctor}/book', [FrontendController::class, 'doctorBook'])->name('frontend.doctor.book');
    Route::post('/doctors/{doctor}/book', [FrontendController::class, 'doctorBookStore'])->middleware('throttle:10,60')->name('frontend.doctor.book.store');
    Route::get('/timetable', [FrontendController::class, 'timetable'])->name('frontend.timetable');
    Route::get('/appointment', [FrontendController::class, 'appointment'])->name('frontend.appointment');
    Route::post('/appointment', [FrontendController::class, 'appointmentStore'])->middleware('throttle:10,60')->name('frontend.appointment.store');
    // Signed, expiring URL: the page shows patient details and must not be
    // reachable by guessing sequential appointment IDs.
    Route::get('/appointment/confirmation/{appointment}', [FrontendController::class, 'appointmentConfirmation'])
        ->middleware('signed')
        ->name('frontend.appointment.confirmation');
    Route::get('/faqs', [FrontendController::class, 'faqs'])->name('frontend.faqs');
    Route::get('/terms', [FrontendController::class, 'terms'])->name('frontend.terms');
    Route::get('/gallery', [FrontendController::class, 'gallery'])->name('frontend.gallery');
    Route::get('/blog', [FrontendController::class, 'blog'])->name('frontend.blog');
    Route::get('/blog/{slug?}', [FrontendController::class, 'blogSingle'])->name('frontend.blog-single');
    Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
    Route::post('/contact', [FrontendController::class, 'contactStore'])->name('frontend.contact.store');

});
