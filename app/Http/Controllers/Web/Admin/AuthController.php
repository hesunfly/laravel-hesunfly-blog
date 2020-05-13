<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/admin/');
        }

        return view('admin.login');
    }

    public function login(AuthRequest $request)
    {
        $authData = [
            'password' => $request->input('password'),
        ];

        $name = $request->input('name');
        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            $authData['email'] = $name;
        } else {
            $authData['name'] = $name;
        }

        if (! Auth::guard('web')->attempt($authData)) {
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
