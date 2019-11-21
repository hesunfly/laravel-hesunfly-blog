<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/');
        }

        return view('login');
    }

    public function login(AuthRequest $request)
    {
        if (! Auth::guard('web')->attempt($request->only(['email', 'password']))) {
            return response('用户名或密码错误', 401);
        }

        return response('success', 200);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return response('success', 204);
    }

}
