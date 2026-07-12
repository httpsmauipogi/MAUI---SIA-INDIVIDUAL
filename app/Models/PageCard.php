<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageCard extends Model
{
    protected $fillable = [
        'page_key', 'group_key', 'icon', 'image_path', 'title', 'subtitle',
        'description', 'link_text', 'link_url', 'sort_order',
    ];

    /**
     * All cards for a page (optionally scoped to one group), in display order.
     */
    public static function forPage(string $pageKey, string $groupKey = 'default')
    {
        return self::where('page_key', $pageKey)
            ->where('group_key', $groupKey)
            ->orderBy('sort_order')
            ->get();
    }
}
