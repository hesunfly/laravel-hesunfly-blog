<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\PageRequest;
use App\Models\Page;
use App\Services\CacheService;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::orderByRaw('id desc')->get();
        return view('admin.page.index')->with([
            'pages' => $pages,
        ]);
    }

    public function create()
    {
        return view('admin.page.create');
    }

    public function store(PageRequest $request)
    {
        $requestData = $request->only([
            'title',
            'content',
            'slug',
            'sort',
            'status',
            'html_content'
        ]);
        Page::create($requestData);

        CacheService::deletePagesCache();

        return response('success', 201);
    }

    public function edit($id)
    {
        $page = $this->findOrFail($id, Page::class);
        return view('admin.page.edit')->with([
            'page' => $page,
            'id' => $id
        ]);
    }

    public function save($id, PageRequest $request)
    {
        $page = $this->findOrFail($id, Page::class);

        $requestData = $request->only([
            'title',
            'content',
            'slug',
            'sort',
            'status',
            'html_content'
        ]);
        $page->update($requestData);
        CacheService::deletePagesCache();

        return response('success', 200);
    }

    public function destroy($id)
    {
        $page = $this->findOrFail($id, Page::class);
        $page->delete();
        CacheService::deletePagesCache();

        return response('success', 204);
    }
}
