<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

if (! function_exists('site_setting')) {
    /**
     * Get a site setting value with a fallback default.
     */
    function site_setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('storage_url')) {
    /**
     * Resolve a URL for a file on the public disk (local storage or S3).
     */
    function storage_url(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        return Storage::disk('public')->url($path);
    }
}
