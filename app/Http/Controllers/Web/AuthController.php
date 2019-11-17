<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
}
