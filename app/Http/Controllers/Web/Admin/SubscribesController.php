<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Subscribe;

class SubscribesController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::paginate(config('blog.admin_page_size'));
        return view('admin.subscribes')->with(['subscribes' => $subscribes]);
    }

}
