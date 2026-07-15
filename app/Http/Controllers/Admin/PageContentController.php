<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageBanner;
use App\Models\PageCard;
use Illuminate\Http\Request;

class PageContentController extends Controller
{
    /**
     * Registry of every frontend page that can be managed from the admin
     * panel: which card groups (if any) it has, and its public route name
     * so we can link out to "View Live".
     *
     * To add a new manageable page later, just add an entry here - no other
     * wiring is needed for the admin side.
     */
    public static function pages(): array
    {
        return [
            'home' => [
                'label' => 'Home',
                'route' => 'frontend.home',
                'groups' => [
                    'hero_slides' => 'Hero Slider',
                    'welcome' => 'Welcome Block (1 card - text + signature + image)',
                    'about_boxes' => 'About Boxes (3 short intro boxes)',
                    'stats' => 'Statistics Counters',
                    'services' => 'Service Highlights',
                    'why_choose_us' => 'Why Choose Us - Intro (1 card - text + image)',
                    'why_choose_us_points' => 'Why Choose Us - Bullet Points (6 short points)',
                    'opening_hours' => 'Opening Hours Table (Title=Day, Subtitle=Hours)',
                    'testimonials' => 'Patient Testimonials',
                    'cta_banner' => 'Bottom Call-to-Action Banner (1 card)',
                ],
                'note' => 'The homepage blog widget automatically reuses the 3 latest posts from Blog > Blog Posts - no separate management needed.',
            ],
            'about' => [
                'label' => 'About Us',
                'route' => 'frontend.about',
                'groups' => [
                    'welcome' => 'Welcome Block (1 card - text + signature + image)',
                    'quality_care' => 'Quality Care Intro (1 card - text + image)',
                    'quality_care_points' => 'Quality Care - 6 Bullet Points',
                    'stats' => 'Statistics Counters',
                    'feature_boxes' => 'Feature Boxes (6 icon boxes)',
                    'opening_hours_intro' => 'Opening Hours - Intro/Footer text (1 card: Title=heading, Description=intro text, Link Text=footer heading, Link URL=footer text)',
                    'opening_hours' => 'Opening Hours Table (Title=Day, Subtitle=Hours)',
                    'closing_banner' => 'Closing Banner (1 card - title, text, image)',
                ],
            ],
            'who-we-are' => [
                'label' => 'Who We Are',
                'route' => 'frontend.who-we-are',
                'groups' => ['features' => 'Feature Cards'],
            ],
            'services' => [
                'label' => 'Services',
                'route' => 'frontend.services',
                'groups' => ['services' => 'Service List'],
            ],
            'departments' => [
                'label' => 'Departments',
                'route' => 'frontend.departments',
                'groups' => ['departments' => 'Department Cards'],
            ],
            'doctors' => [
                'label' => 'Doctors',
                'route' => 'frontend.doctors',
                'groups' => [],
                'note' => 'Doctor cards come from the Doctors module, not from here.',
            ],
            'timetable' => [
                'label' => 'Timetable',
                'route' => 'frontend.timetable',
                'groups' => [],
            ],
            'appointment' => [
                'label' => 'Appointment',
                'route' => 'frontend.appointment',
                'groups' => [],
            ],
            'faqs' => [
                'label' => 'FAQs',
                'route' => 'frontend.faqs',
                'groups' => ['faqs' => 'FAQ Items'],
            ],
            'terms' => [
                'label' => 'Terms',
                'route' => 'frontend.terms',
                'groups' => [],
            ],
            'gallery' => [
                'label' => 'Gallery',
                'route' => 'frontend.gallery',
                'groups' => ['images' => 'Gallery Images'],
            ],
            'blog' => [
                'label' => 'Blog',
                'route' => 'frontend.blog',
                'groups' => ['posts' => 'Blog Posts'],
            ],
            'contact' => [
                'label' => 'Contact',
                'route' => 'frontend.contact',
                'groups' => ['info_boxes' => 'Contact Info Boxes'],
            ],
        ];
    }

    public function index()
    {
        $pages = self::pages();

        return view('backend.page-content.index', compact('pages'));
    }

    public function edit(string $pageKey)
    {
        $pages = self::pages();
        abort_unless(array_key_exists($pageKey, $pages), 404);

        $page = $pages[$pageKey];
        $banner = PageBanner::forPage($pageKey);

        $cardGroups = [];
        foreach ($page['groups'] as $groupKey => $groupLabel) {
            $cardGroups[$groupKey] = [
                'label' => $groupLabel,
                'cards' => PageCard::forPage($pageKey, $groupKey),
            ];
        }

        return view('backend.page-content.edit', [
            'pageKey' => $pageKey,
            'page' => $page,
            'banner' => $banner,
            'cardGroups' => $cardGroups,
        ]);
    }

    public function updateBanner(Request $request, string $pageKey)
    {
        abort_unless(array_key_exists($pageKey, self::pages()), 404);

        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $banner = PageBanner::forPage($pageKey);
        $banner->title = $validated['title'] ?? null;
        $banner->subtitle = $validated['subtitle'] ?? null;
        $banner->description = $validated['description'] ?? null;

        if ($request->hasFile('image')) {
            $banner->image_path = $request->file('image')->store('page-content', 'public');
        }

        $banner->save();

        return back()->with('status', 'Banner updated successfully.');
    }

    public function storeCard(Request $request, string $pageKey)
    {
        abort_unless(array_key_exists($pageKey, self::pages()), 404);

        $validated = $this->validateCard($request);
        $validated['page_key'] = $pageKey;
        $validated['group_key'] = $request->input('group_key', 'default');

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('page-content', 'public');
        }

        $validated['sort_order'] = (int) PageCard::where('page_key', $pageKey)
            ->where('group_key', $validated['group_key'])
            ->max('sort_order') + 1;

        PageCard::create($validated);

        return back()->with('status', 'Card added successfully.');
    }

    public function updateCard(Request $request, PageCard $card)
    {
        $validated = $this->validateCard($request);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('page-content', 'public');
        }

        $card->update($validated);

        return back()->with('status', 'Card updated successfully.');
    }

    public function destroyCard(PageCard $card)
    {
        $card->delete();

        return back()->with('status', 'Card deleted successfully.');
    }

    /**
     * Move a card up or down within its group by swapping sort_order with
     * its neighbour. Simple and dependency-free (no JS drag library needed).
     */
    public function moveCard(Request $request, PageCard $card)
    {
        $direction = $request->input('direction');

        $neighbour = PageCard::where('page_key', $card->page_key)
            ->where('group_key', $card->group_key)
            ->where('id', '!=', $card->id)
            ->when($direction === 'up', fn ($q) => $q->where('sort_order', '<=', $card->sort_order)->orderByDesc('sort_order'))
            ->when($direction === 'down', fn ($q) => $q->where('sort_order', '>=', $card->sort_order)->orderBy('sort_order'))
            ->first();

        if ($neighbour) {
            $originalOrder = $card->sort_order;
            $card->update(['sort_order' => $neighbour->sort_order]);
            $neighbour->update(['sort_order' => $originalOrder]);
        }

        return back();
    }

    private function validateCard(Request $request): array
    {
        return $request->validate([
            'icon' => ['nullable', 'string', 'max:100'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'link_text' => ['nullable', 'string', 'max:100'],
            'link_url' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }
}
