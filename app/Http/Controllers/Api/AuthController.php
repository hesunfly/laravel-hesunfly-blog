<?php

namespace App\Http\Controllers\Api;

use App\Events\LoginLogEvent;
use App\Events\UpdateLoginIpEvent;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Models\Profile;
use App\Services\VerifyCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function login(AuthRequest $request)
    {
        if (!$token = Auth::guard('api')->attempt($request->only(['email', 'password']))) {
            $this->response->errorUnauthorized('密码错误!');
        }
        $remoteIp = $request->ip();
        event(new UpdateLoginIpEvent($this->userId(), $remoteIp));
        event(new LoginLogEvent($this->userId(), $remoteIp));

        return $this->respondWithToken($token);
    }

    public function register(AuthRequest $request)
    {
        if (!VerifyCode::checkEmailVerifyCode($request->key, $request->email, $request->verify_code)) {
            $this->response->error('验证码错误', 401);
        }
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Profile::create(['user_id' => $user->id]);

        DB::commit();

        return $this->response->created();
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }

    public function logout()
    {
        Auth::logout();
        return $this->response->noContent();
    }

    public function emailVerifyCode($email)
    {
        return $this->response->array(VerifyCode::email($email));
    }

    public function github()
    {
        return Socialite::with('github')->stateless()->redirect();
    }

    public function githubCallback()
    {
        $github = Socialite::with('github')->stateless()->user();
        $user = User::where(['email' => $github->email])->first();
        //github登录
        if (empty($user)) {
            $user = User::create([
                'name' => $github->name,
                'email' => $github->email,
                'password' => 123456,
                'github' => $github->user['html_url'],
            ]);

            Profile::create(['user_id' => $user->id]);

            return $this->response->created();
        }

        $user->github = $github->user['html_url'];
        $user->save();

        return $this->response->created();
    }

    private function respondWithToken($token)
    {
        return response()->json(
            ['data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ],
            ]);
    }

}
