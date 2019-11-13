<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }
}
