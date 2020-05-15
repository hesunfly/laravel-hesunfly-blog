<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\UserRequest;
use App\Services\CacheService;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function edit()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('web')->user();
        return view('admin.user', ['user' => $user]);
    }
    
    public function update(UserRequest $request)
    {
        $requestData = $request->only(['name', 'email', 'password', 'avatar']);
        $temp = [];
        foreach ($requestData as $k => $item) {
            if (empty($item)) {
                continue;
            }
            $temp[$k] = $item;
        }

        Auth::guard('web')->user()->update($temp);

        CacheService::setAvatar($requestData['avatar']);

        if (array_key_exists('password', $temp)) {
            return response('success', 201);
        }

        return response('success', 200);
    }
}
