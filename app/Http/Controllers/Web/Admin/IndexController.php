<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
