<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Setting;
use App\Services\CacheService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (empty($setting)) {
            Setting::create(['id' => 1]);
        }
        $setting = Setting::first()->toArray();

        $setting_fmt = [];
        foreach ($setting as $k => $item) {
            $setting_fmt[] = [
                'name' => $k,
                'value' => $item,
                'title' => Setting::$setting_title[$k]['title'],
                'en_title' => Setting::$setting_title[$k]['en_title']
            ];
        }

        return view('admin.setting')->with(['settings' => $setting_fmt]);
    }

    public function save(Request $request)
    {
        $request_data = $request->all();

        foreach ($request_data as $k => $item) {
            $request_data[$k] = empty($item) ? '' : $item;
        }

        Setting::first()->update($request_data);

        CacheService::destroyConfig();

        return response('success');
    }

}
