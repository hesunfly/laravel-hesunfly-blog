<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Subscribe;
use App\Services\CacheService;

class SubscribesController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::paginate(CacheService::getConfig('admin_page_size'));
        return view('admin.subscribes')->with(['subscribes' => $subscribes]);
    }

}
