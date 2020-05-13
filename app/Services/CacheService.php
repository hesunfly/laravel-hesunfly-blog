<?php


namespace App\Services;


use App\Models\Page;
use App\Models\Setting;
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

    public static function getConfig($key)
    {
        $cache_key = 'config_' . $key;
        $config = Cache::get($cache_key);

        if (empty($config)) {
            $db_config = Setting::select($key)->first();
            $config = Setting::$setting_title[$key]['default'];
            if (!empty($db_config->$key)) {
                $config = $db_config->$key;
            }
        }

        Cache::forever($cache_key , $config);

        return $config;
    }

    public static function destroyConfig()
    {
        foreach (array_keys(Setting::$setting_title) as $item) {
            Cache::forget('config_' . $item);
        }
    }

    public static $avatar_key = 'config_avatar';

    public static function setAvatar($value)
    {
        Cache::forever(self::$avatar_key, $value);
    }

    public static function getAvatar()
    {
        $config = Cache::get(self::$avatar_key);
        if (empty($config)) {
            $config = '/assets/images/avatar.jpg';
        }

        return $config;
    }
}