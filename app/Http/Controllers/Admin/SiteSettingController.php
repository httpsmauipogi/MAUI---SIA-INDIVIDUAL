<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    private array $fields = [
        // General
        'site_name', 'tagline', 'phone', 'emergency_phone', 'email', 'address',
        // Social
        'facebook_url', 'twitter_url', 'instagram_url', 'linkedin_url', 'youtube_url',
        // Homepage
        'hero_title', 'hero_subtitle', 'hero_description',
        // Footer
        'footer_about', 'copyright_text',
        // System
        'maintenance_mode',
    ];

    public function edit()
    {
        $settings = Setting::allCached();

        return view('backend.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'emergency_phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string', 'max:1000'],
            'footer_about' => ['nullable', 'string', 'max:1000'],
            'copyright_text' => ['nullable', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'favicon' => ['nullable', 'image', 'max:512'],
            'maintenance_mode' => ['nullable', 'boolean'],
        ]);

        foreach ($this->fields as $field) {
            if ($field === 'maintenance_mode') {
                Setting::set('maintenance_mode', $request->boolean('maintenance_mode') ? '1' : '0');
                continue;
            }
            if (array_key_exists($field, $validated)) {
                Setting::set($field, $validated[$field]);
            }
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('site', 'public');
            Setting::set('logo_path', $path);
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('site', 'public');
            Setting::set('favicon_path', $path);
        }

        return back()->with('status', 'Website settings updated successfully.');
    }
}
