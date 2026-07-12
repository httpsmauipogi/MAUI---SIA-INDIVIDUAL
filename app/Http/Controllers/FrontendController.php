<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\PageCard;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $featuredDoctors = Doctor::where('status', 'Active')->orderBy('name')->limit(4)->get();
        $heroSlides = PageCard::forPage('home', 'hero_slides');
        $homeServiceCards = PageCard::forPage('home', 'services');
        $aboutBoxCards = PageCard::forPage('home', 'about_boxes');
        $statCards = PageCard::forPage('home', 'stats');
        $welcomeCard = PageCard::forPage('home', 'welcome')->first() ?? new PageCard();
        $whyChooseUsCard = PageCard::forPage('home', 'why_choose_us')->first() ?? new PageCard();
        $whyChooseUsPoints = PageCard::forPage('home', 'why_choose_us_points');
        $openingHours = PageCard::forPage('home', 'opening_hours');
        $testimonialCards = PageCard::forPage('home', 'testimonials');
        $homeBlogCards = PageCard::forPage('blog', 'posts')->take(3);
        $ctaCard = PageCard::forPage('home', 'cta_banner')->first() ?? new PageCard();

        return view('frontend.home', compact(
            'featuredDoctors', 'heroSlides', 'homeServiceCards', 'aboutBoxCards', 'statCards',
            'welcomeCard', 'whyChooseUsCard', 'whyChooseUsPoints', 'openingHours',
            'testimonialCards', 'homeBlogCards', 'ctaCard'
        ));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function whoWeAre()
    {
        return view('frontend.who-we-are');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function departments()
    {
        $departmentCards = PageCard::forPage('departments', 'departments');

        return view('frontend.departments', compact('departmentCards'));
    }

    public function departmentSingle()
    {
        return view('frontend.department-single');
    }

    public function doctors()
    {
        $doctors = Doctor::where('status', 'Active')->orderBy('name')->get();

        return view('frontend.doctors', compact('doctors'));
    }

    public function doctorShow(Doctor $doctor)
    {
        abort_unless($doctor->status === 'Active', 404);

        return view('frontend.doctor-show', compact('doctor'));
    }

    public function timetable()
    {
        return view('frontend.timetable');
    }

    public function appointment()
    {
        $doctors = Doctor::where('status', 'Active')->orderBy('name')->get();

        return view('frontend.appointment', compact('doctors'));
    }

    public function appointmentStore(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => ['required', 'exists:doctors,id'],
            'department' => ['nullable', 'string', 'max:255'],
            'patient_type' => ['nullable', 'string', 'max:50'],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'message' => ['nullable', 'string'],
        ]);

        $patient = \App\Models\Patient::firstOrCreate(
            ['phone' => $validated['phone']],
            [
                'name' => $validated['name'],
                'gender' => $validated['gender'],
                'email' => $validated['email'],
                'status' => 'Active',
            ]
        );

        $reasonParts = array_filter([
            $validated['department'] ?? null,
            $validated['patient_type'] ?? null,
        ]);

        \App\Models\Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $validated['doctor_id'],
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => '10:00',
            'reason' => implode(' - ', $reasonParts) ?: 'Website appointment request',
            'status' => 'Scheduled',
            'notes' => $validated['message'] ?? null,
        ]);

        return back()->with('appointment_status', 'Thank you! Your appointment request has been received. Our team will contact you shortly to confirm the exact time.');
    }

    public function faqs()
    {
        $faqCards = PageCard::forPage('faqs', 'faqs');

        return view('frontend.faqs', compact('faqCards'));
    }

    public function terms()
    {
        return view('frontend.terms');
    }

    public function gallery()
    {
        $galleryCards = PageCard::forPage('gallery', 'images');

        return view('frontend.gallery', compact('galleryCards'));
    }

    public function blog()
    {
        $blogCards = PageCard::forPage('blog', 'posts');

        return view('frontend.blog', compact('blogCards'));
    }

    public function blogSingle()
    {
        return view('frontend.blog-single');
    }

    public function contact()
    {
        $infoBoxCards = PageCard::forPage('contact', 'info_boxes');

        return view('frontend.contact', compact('infoBoxCards'));
    }

    public function contactStore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $contactMessage = \App\Models\ContactMessage::create($validated);

        \App\Services\NotifyService::roles(
            ['Super Admin', 'Hospital Admin', 'Receptionist'],
            'New contact message',
            $contactMessage->name . ' sent a message: ' . \Illuminate\Support\Str::limit($contactMessage->message, 60),
            route('admin.messages.show', $contactMessage),
            'iconoir-mail-out',
            'info'
        );

        return back()->with('contact_status', "Thank you for reaching out! We've received your message and will get back to you soon.");
    }

}
