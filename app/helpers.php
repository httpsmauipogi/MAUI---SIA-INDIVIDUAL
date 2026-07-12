<?php

use App\Models\Setting;

if (! function_exists('site_setting')) {
    /**
     * Get a site setting value with a fallback default.
     */
    function site_setting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }
}
