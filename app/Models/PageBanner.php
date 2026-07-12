<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBanner extends Model
{
    protected $fillable = [
        'page_key', 'title', 'subtitle', 'description', 'image_path',
    ];

    /**
     * Fetch (or build an empty placeholder for) the banner belonging to a page.
     */
    public static function forPage(string $pageKey): self
    {
        return self::firstOrNew(['page_key' => $pageKey]);
    }
}
