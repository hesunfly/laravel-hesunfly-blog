<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\AdRequest;
use App\Models\Ad;
use App\Services\CacheService;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::orderByRaw('sort')->get();
        return view('admin.ad.index')->with([
            'ads' => $ads,
        ]);
    }

    public function create()
    {
        return view('admin.ad.create');
    }

    public function store(AdRequest $request)
    {
        $requestData = $request->only([
            'desc',
            'url',
            'img_path',
            'sort',
            'status',
        ]);
        Ad::create($requestData);

        CacheService::deleteAds();

        return response('success', 201);
    }

    public function edit($id)
    {
        $ad = $this->findOrFail($id, Ad::class);
        return view('admin.ad.edit')->with([
            'ad' => $ad,
            'id' => $id
        ]);
    }

    public function save($id, AdRequest $request)
    {
        $ad = $this->findOrFail($id, Ad::class);

        $requestData = $request->only([
            'desc',
            'url',
            'img_path',
            'sort',
            'status',
        ]);
        $ad->update($requestData);
        CacheService::deleteAds();

        return response('success', 200);
    }

    public function destroy($id)
    {
        $ad = $this->findOrFail($id, Ad::class);
        $ad->delete();
        CacheService::deleteAds();

        return response('success', 204);
    }
}
