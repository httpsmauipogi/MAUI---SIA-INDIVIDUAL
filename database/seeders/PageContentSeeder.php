<?php

namespace Database\Seeders;

use App\Models\PageBanner;
use App\Models\PageCard;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Seeds the page_banners / page_cards tables with the site's original
     * hardcoded text so switching to the new Admin > Page Content system
     * does not leave any page blank.
     */
    public function run(): void
    {
        $banners = [
            'about' => 'About Us',
            'who-we-are' => 'Who We Are',
            'services' => 'Our Services',
            'departments' => 'Our Departments',
            'timetable' => 'Timetable',
            'appointment' => 'Appointment',
            'faqs' => 'FAQs',
            'terms' => 'Terms & Privacy',
            'gallery' => 'Our Gallery',
            'blog' => 'Our Blogs & Latest News',
            'doctors' => 'Meet the Doctors',
        ];

        foreach ($banners as $key => $title) {
            PageBanner::firstOrCreate(['page_key' => $key], ['title' => $title]);
        }

        // Home hero slider (originally hardcoded slides)
        $heroSlides = [
            [
                'title' => 'Bring world into focus',
                'description' => 'Feugiat primis ligula risus auctor egestas augue mauri viverra tortor in iaculis placerat eugiat mauris ipsum at viverra tortor and gravida purus pretium auctor lorem primis mollis',
                'link_text' => 'Get More Info',
                'link_url' => '/who-we-are',
                'image_path' => null,
            ],
            [
                'title' => 'Enhancing your vision',
                'description' => 'Fringilla risus nec, luctus mauris orci auctor purus euismod pretium purus pretium ligula rutrum tempor sapien.',
                'link_text' => 'Meet the Doctors',
                'link_url' => '/doctors',
                'image_path' => null,
            ],
        ];
        $this->seedCards('home', 'hero_slides', $heroSlides);

        // Home service highlight cards
        $homeServices = [
            ['title' => 'Eye Examination', 'description' => 'Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor at pretium feugiat dolor integer.'],
            ['title' => 'Laser Eye Correction', 'description' => 'Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor at pretium feugiat dolor integer.'],
            ['title' => 'Contact Lenses', 'description' => 'Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor at pretium feugiat dolor integer.'],
            ['title' => 'Kids Diagnostic', 'description' => 'Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor at pretium feugiat dolor integer.'],
        ];
        $this->seedCards('home', 'services', $homeServices);

        // Home "About" intro boxes
        $aboutBoxes = [
            ['subtitle' => 'Qualified Doctors', 'title' => 'Where People Come First', 'description' => 'An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum vitae a purus primis ipsum magna ipsum.'],
            ['subtitle' => '24 Hour Service', 'title' => 'Highest Quality Care', 'description' => 'An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum vitae a purus primis ipsum magna ipsum.'],
            ['subtitle' => 'Here For You', 'title' => 'Emergency Department', 'description' => 'An magnis nulla dolor at sapien augue erat iaculis purus tempor magna ipsum vitae a purus primis ipsum magna ipsum.'],
        ];
        $this->seedCards('home', 'about_boxes', $aboutBoxes);

        // Home statistics counters (title = number, subtitle = label)
        $stats = [
            ['icon' => 'flaticon-062-cardiogram-3', 'title' => '9,632', 'subtitle' => 'Happy Patients'],
            ['icon' => 'flaticon-137-doctor', 'title' => '58', 'subtitle' => 'Qualified Doctors'],
            ['icon' => 'flaticon-065-hospital-bed', 'title' => '864', 'subtitle' => 'Clinic Rooms'],
            ['icon' => 'flaticon-040-placeholder', 'title' => '473', 'subtitle' => 'Local Partners'],
        ];
        $this->seedCards('home', 'stats', $stats);

        // Home "Welcome" block
        $welcome = [[
            'subtitle' => 'Welcome to Healix HMS',
            'title' => 'Complete Medical Solutions in One Place',
            'description' => 'Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat dolor lacinia cubilia curae integer congue leo metus, eu mollis lorem primis in orci integer metus mollis faucibus.',
            'link_text' => 'Randon Pexon, Head of Clinic',
        ]];
        $this->seedCards('home', 'welcome', $welcome);

        // Home "Why Choose Us" intro + bullet points
        $whyChooseUs = [[
            'subtitle' => 'Best Practices',
            'title' => 'Clinic with Innovative Approach to Treatment',
            'description' => 'An enim nullam tempor sapien gravida donec enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum.',
        ]];
        $this->seedCards('home', 'why_choose_us', $whyChooseUs);

        $whyChooseUsPoints = [
            ['title' => 'Board-certified specialists across every department'],
            ['title' => 'Modern diagnostic and treatment equipment'],
            ['title' => '24/7 emergency and on-call support'],
            ['title' => 'Transparent billing with no hidden charges'],
            ['title' => 'Comfortable, well-maintained patient rooms'],
            ['title' => 'Easy online appointment booking'],
        ];
        $this->seedCards('home', 'why_choose_us_points', $whyChooseUsPoints);

        // Home opening hours table
        $openingHours = [
            ['title' => 'Mon – Wed', 'subtitle' => '9:00 AM - 7:00 PM'],
            ['title' => 'Thursday', 'subtitle' => '9:00 AM - 6:30 PM'],
            ['title' => 'Friday', 'subtitle' => '9:00 AM - 6:00 PM'],
            ['title' => 'Sun - Sun', 'subtitle' => 'Closed'],
        ];
        $this->seedCards('home', 'opening_hours', $openingHours);

        // Home testimonials
        $testimonials = [
            ['title' => 'Scott Boxer', 'subtitle' => 'Programmer', 'description' => 'Etiam sapien sem at sagittis congue an augue massa varius egestas a suscipit magna undo tempus aliquet porta vitae.'],
            ['title' => 'Penelopa Peterson', 'subtitle' => 'Project Manager', 'description' => 'Mauris donec ociis magnisa a sapien etiam sapien congue augue egestas et ultrice vitae purus diam integer congue magna ligula egestas.'],
            ['title' => 'Robert Kaine', 'subtitle' => 'Accountant', 'description' => 'The staff were incredibly caring throughout my treatment and made a stressful time much easier to manage.'],
            ['title' => 'Emily Turner', 'subtitle' => 'Teacher', 'description' => 'From booking the appointment to follow-up care, everything was smooth and professional.'],
            ['title' => 'David Lee', 'subtitle' => 'Engineer', 'description' => 'The doctors took the time to explain everything clearly - I felt genuinely looked after.'],
            ['title' => 'Sarah Collins', 'subtitle' => 'Designer', 'description' => 'Clean facilities, friendly staff, and short wait times. Highly recommend this hospital.'],
            ['title' => 'Michael Brown', 'subtitle' => 'Consultant', 'description' => 'Excellent emergency response - they had me stabilized and comfortable within minutes.'],
            ['title' => 'Laura Wilson', 'subtitle' => 'Nurse', 'description' => 'As someone in healthcare myself, I was impressed by how well-organized the whole visit was.'],
            ['title' => 'James Carter', 'subtitle' => 'Business Owner', 'description' => 'Great experience overall - the follow-up calls after my procedure showed they really care.'],
        ];
        $this->seedCards('home', 'testimonials', $testimonials);

        // Home bottom CTA banner
        $ctaBanner = [[
            'subtitle' => 'Modern Medicine',
            'title' => 'Better Technologies for Better Healthcare',
            'description' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue egestas suscipit lectus mauris lectus laoreet gestas neque undo luctus feugiat.',
            'link_text' => 'View Our Doctors',
            'link_url' => '/doctors',
        ]];
        $this->seedCards('home', 'cta_banner', $ctaBanner);

        // About Us page
        $aboutWelcome = [[
            'subtitle' => 'Welcome to Healix HMS',
            'title' => 'Clinic with Innovative Approach to Treatment',
            'description' => "An enim nullam tempor sapien gravida donec pretium ipsum porta justo integer at odio velna vitae auctor integer congue magna purus pretium ligula rutrum luctus ultrice aliquam a augue suscipit.\n\nPorta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat dolor lacinia cubilia curae integer congue leo metus, eu mollis lorem primis in orci integer metus mollis faucibus.",
            'link_text' => 'Randon Pexon, Head of Clinic',
        ]];
        $this->seedCards('about', 'welcome', $aboutWelcome);

        $aboutQualityCare = [[
            'subtitle' => 'Highest Quality Care',
            'title' => 'Complete Medical Solutions in One Place',
            'description' => 'An enim nullam tempor sapien gravida donec enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum itae laoreet augue posuere.',
        ]];
        $this->seedCards('about', 'quality_care', $aboutQualityCare);

        $aboutQualityPoints = [
            ['title' => 'Comprehensive diagnostic and treatment services'],
            ['title' => 'Compassionate, patient-first approach'],
            ['title' => 'State-of-the-art medical equipment'],
            ['title' => 'Experienced, board-certified specialists'],
            ['title' => 'Round-the-clock emergency care'],
            ['title' => 'Affordable, transparent pricing'],
        ];
        $this->seedCards('about', 'quality_care_points', $aboutQualityPoints);

        $aboutStats = [
            ['icon' => 'flaticon-062-cardiogram-3', 'title' => '9,632', 'subtitle' => 'Happy Patients'],
            ['icon' => 'flaticon-137-doctor', 'title' => '178', 'subtitle' => 'Qualified Doctors'],
            ['icon' => 'flaticon-065-hospital-bed', 'title' => '864', 'subtitle' => 'Clinic Rooms'],
            ['icon' => 'flaticon-040-placeholder', 'title' => '473', 'subtitle' => 'Local Partners'],
        ];
        $this->seedCards('about', 'stats', $aboutStats);

        $aboutFeatureBoxes = [
            ['icon' => 'flaticon-137-doctor', 'title' => 'Top Level Doctors', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.'],
            ['icon' => 'flaticon-076-microscope', 'title' => 'Modern Equipment', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.'],
            ['icon' => 'flaticon-065-hospital-bed', 'title' => 'Qualified Facilities', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.'],
            ['icon' => 'flaticon-058-blood-transfusion-2', 'title' => 'Emergency Help', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.'],
            ['icon' => 'flaticon-048-lungs', 'title' => 'Health Checkups', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.'],
            ['icon' => 'flaticon-031-scanner', 'title' => 'Diagnostic Services', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.'],
        ];
        $this->seedCards('about', 'feature_boxes', $aboutFeatureBoxes);

        $aboutOpeningHoursIntro = [[
            'title' => 'Opening Hours:',
            'description' => 'Porta semper lacus cursus and feugiat primis ultrice ligula risus auctor tempus feugiat and dolor lacinia cursus.',
            'link_text' => 'Need a personal health plan?',
            'link_url' => 'Porta semper lacus cursus, and feugiat primis ultrice ligula at risus auctor',
        ]];
        $this->seedCards('about', 'opening_hours_intro', $aboutOpeningHoursIntro);

        $aboutOpeningHours = [
            ['title' => 'Mon – Wed', 'subtitle' => '9:00 AM - 7:00 PM'],
            ['title' => 'Thursday', 'subtitle' => '9:00 AM - 6:30 PM'],
            ['title' => 'Friday', 'subtitle' => '9:00 AM - 6:00 PM'],
            ['title' => 'Sun - Sun', 'subtitle' => 'CLOSED'],
        ];
        $this->seedCards('about', 'opening_hours', $aboutOpeningHours);

        $aboutClosingBanner = [[
            'title' => 'Certified and Experienced Doctors',
            'description' => 'Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, blandit posuere ligula varius congue cursus porta feugiat.',
        ]];
        $this->seedCards('about', 'closing_banner', $aboutClosingBanner);

        // Departments page cards
        $departments = [
            ['title' => 'Pediatrics', 'icon' => 'flaticon-083-stethoscope', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'Neurology', 'icon' => 'flaticon-047-head', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'Haematology', 'icon' => 'flaticon-015-blood-donation-1', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'X-Ray Diagnostic', 'icon' => 'flaticon-048-lungs', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'Cardiology', 'icon' => 'flaticon-060-cardiogram-4', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'MRI Diagnostics', 'icon' => 'flaticon-031-scanner', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'Laboratory Services', 'icon' => 'flaticon-076-microscope', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
            ['title' => 'Emergency Help', 'icon' => 'flaticon-068-ambulance-3', 'description' => 'Porta semper lacus at cursus primis ultrice in ligula risus an auctor tempus feugiat dolor.', 'link_url' => '/services'],
        ];
        $this->seedCards('departments', 'departments', $departments);

        // FAQs
        $faqs = [
            ['title' => 'What are your hospital visiting hours?', 'description' => 'General visiting hours are 8:00 AM - 8:00 PM on weekdays, 10:00 AM - 6:00 PM on Saturdays, and 10:00 AM - 4:00 PM on Sundays. ICU visiting hours may differ - please check with the nursing desk.'],
            ['title' => 'How do I book an appointment?', 'description' => 'You can book an appointment online through our Appointment page, by calling our front desk, or by creating a free patient account to manage all your visits in one place.'],
            ['title' => 'Do you accept health insurance?', 'description' => 'Yes, we work with most major health insurance providers. Please bring your insurance card and ID at the time of your visit, or contact our billing desk beforehand to confirm coverage.'],
            ['title' => 'What should I bring to my first appointment?', 'description' => 'Please bring a valid photo ID, your insurance card (if applicable), a list of current medications, and any relevant previous medical records or referral letters.'],
            ['title' => 'Can I get my prescriptions and reports online?', 'description' => 'Yes. Patients with a registered account can log in to the Patient Portal to view prescriptions, appointment history, and invoices at any time.'],
            ['title' => 'Do you offer emergency services?', 'description' => 'Yes, our emergency department is open 24/7. For life-threatening emergencies, please call our emergency hotline or visit the emergency entrance directly.'],
            ['title' => 'How can I contact a specific department?', 'description' => 'You can find contact details for each department on our Departments page, or call our main reception and ask to be transferred to the relevant department.'],
            ['title' => 'What safety measures are in place at the hospital?', 'description' => 'We follow strict hygiene and infection-control protocols throughout the hospital, including regular sanitization, trained staff, and safety guidelines for all visitors and patients.'],
            ['title' => 'Can I request a specific doctor?', 'description' => 'Yes, when booking your appointment you can choose your preferred doctor from our Doctors page, subject to their availability.'],
            ['title' => 'How do I pay my hospital bill?', 'description' => 'Bills can be paid at the billing counter, or online once payment options are enabled for your patient account. Detailed invoices are available on request.'],
            ['title' => 'Do you provide diagnostic and lab services?', 'description' => 'Yes, we offer a full range of diagnostic and laboratory services on-site, including X-Ray, MRI, and blood work, with most results available within 24-48 hours.'],
            ['title' => 'How can I give feedback about my visit?', 'description' => 'We welcome your feedback through our Contact page, or you can speak directly with our Patient Experience Coordinator during your visit.'],
        ];
        $this->seedCards('faqs', 'faqs', $faqs);

        // Gallery (icon field stores the filter category slug: dental / pediatric / cardiology)
        $galleryCategories = ['dental', 'pediatric', 'cardiology'];
        $galleryImages = [];
        for ($i = 0; $i < 12; $i++) {
            $galleryImages[] = ['icon' => $galleryCategories[$i % 3], 'title' => 'Hospital Gallery Photo ' . ($i + 1)];
        }
        $this->seedCards('gallery', 'images', $galleryImages);

        // Blog posts
        $blogPosts = [
            ['title' => '5 Benefits Of Integrative Medicine', 'subtitle' => 'By Dr. Jeremy Smith', 'description' => 'A look at how combining conventional and complementary approaches can improve overall patient outcomes and wellbeing.'],
            ['title' => 'Why Regular Health Checkups Matter', 'subtitle' => 'By Dr. Sarah Lee', 'description' => 'Routine screenings help catch potential health issues early, when they are most treatable - here is what to expect.'],
            ['title' => 'Understanding Your Vaccination Schedule', 'subtitle' => 'By Dr. Amir Khan', 'description' => 'A simple guide to childhood and adult immunizations, and why staying on schedule protects the whole family.'],
            ['title' => 'Managing Stress For Better Heart Health', 'subtitle' => 'By Dr. Emily Chen', 'description' => 'Practical, evidence-based tips for reducing daily stress and supporting long-term cardiovascular health.'],
        ];
        $this->seedCards('blog', 'posts', $blogPosts);

        // Contact info boxes
        $infoBoxes = [
            ['title' => 'General Information', 'description' => "121 King Street, Melbourne,\nVictoria 3000 Australia\nPhone: +12 9 8765 4321\nEmail: hello@yourdomain.com"],
            ['title' => 'Patient Experience', 'description' => "Hannah Harper - Patient Experience Coordinator\nPhone: +12 9 8765 4321\nEmail: hello@yourdomain.com"],
            ['title' => 'Working Hours', 'description' => "Monday - Friday : 8:00 AM - 8:00 PM\nSaturday : 10:00 AM - 6:00 PM\nSunday : 10:00 AM - 4:00 PM"],
        ];
        $this->seedCards('contact', 'info_boxes', $infoBoxes);
    }

    private function seedCards(string $pageKey, string $groupKey, array $cards): void
    {
        if (PageCard::where('page_key', $pageKey)->where('group_key', $groupKey)->exists()) {
            return;
        }

        foreach ($cards as $i => $card) {
            PageCard::create(array_merge($card, [
                'page_key' => $pageKey,
                'group_key' => $groupKey,
                'sort_order' => $i,
            ]));
        }
    }
}
