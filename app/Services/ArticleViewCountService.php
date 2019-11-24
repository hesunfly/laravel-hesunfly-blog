<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ArticleViewCountService
{
    public static function view($id, $ip)
    {
        $key = 'view_article_' . $id . ':' . $ip;
        if (Cache::has($key)) {
            return false;
        }

        Cache::put($key, 'view', Carbon::now()->addHours(12));

        return true;
    }
}