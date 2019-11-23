<?php


namespace App\Services;


use App\Models\Page;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public static function getPages()
    {
        $pages = Cache::get('index_pages_items');

        if (empty($pages)) {
            $pages = Page::whereRaw('status = 1')->select(['slug', 'title'])->orderBy('sort')->get();
        }

        Cache::forever('index_pages_items', $pages);

        return $pages;
    }

    public static function deletePagesCache()
    {
        Cache::forget('index_pages_items');
    }
}