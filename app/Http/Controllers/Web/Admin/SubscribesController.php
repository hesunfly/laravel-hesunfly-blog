<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Subscribe;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscribesController extends Controller
{
    public function index()
    {
        $subscribes = Subscribe::paginate(CacheService::getConfig('admin_page_size'));
        return view('admin.subscribes')->with(['subscribes' => $subscribes]);
    }

    public function setStatus($id, Request $request)
    {
        $item = $this->findOrFail($id, Subscribe::class);

        $request->validate([
            'status' => Rule::in(['1', '0'])
        ]);

        $item->update(['status' => $request->input('status')]);

        return response('success', 200);
    }

    public function destroy($id)
    {
        $item = $this->findOrFail($id, Subscribe::class);

        $item->delete();

        return response('success', 204);
    }

}
