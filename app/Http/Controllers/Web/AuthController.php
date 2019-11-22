<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\AuthRequest;
use App\Models\Profile;
use App\Models\User;
use App\Services\VerifyCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $name = $request->input('name');
        $authName = $this->authName($name);
        $authData = [
            $authName => $name,
            'password' => $request->input('password'),
        ];

        if (! Auth::guard('web')->attempt($authData)) {
            return response('用户名或密码错误', 401);
        }

        return response('success', 200);
    }

    public function showRegister()
    {
        if (Auth::guard('web')->check()) {
            return redirect('/');
        }

        return view('register');
    }

    public function register(AuthRequest $request)
    {
        if (!VerifyCode::checkEmailVerifyCode($request->input('key'), $request->input('email'), $request->input('verify_code'))) {
            return response('验证码错误', 401);
        }

        DB::beginTransaction();
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        Profile::create(['user_id' => $user->id]);

        DB::commit();

        return response('success', 201);
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return response('success', 204);
    }

    public function emailVerifyCode($email)
    {
        if(! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response('error', 422);
        }

        return response(VerifyCode::email($email));
    }

    private function authName($name)
    {
        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        }

        return 'name';
    }
}
