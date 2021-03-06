<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\AuthRequestTrait;
use App\Http\Requests\MemberRequest;
use App\Models\User;
use App\Models\Profile;
use App\Transformers\UserTransformer;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $user = User::with('profile')->paginate(15);

        return $this->response->paginator($user, new UserTransformer());
    }

    public function show($id)
    {
        $user = User::with('profile')->find($id);

        return $this->response->item($user, new UserTransformer());
    }

    public function store(MemberRequest $request)
    {
        DB::beginTransaction();
        $user  = User::create($request->only(['name', 'password', 'email']));

        Profile::create(['user_id' => $user->id]);
        DB::commit();
        return $this->response->item($user, new UserTransformer());
    }

    public function update($id, MemberRequest $request)
    {
        $this->findOrFail($id, User::class);
        User::where('id', $id)->update(['status' => (int) $request->status]);
        $user = $this->findOrFail($id, User::class);

        return $this->response->item($user, new UserTransformer());
    }
}
