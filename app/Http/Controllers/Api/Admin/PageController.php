<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Services\MarkdownService;
use App\Transformers\PagesTransformer;
use App\Transformers\PageTransformer;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::select(['id', 'title', 'status', 'sort', 'comment_status', 'updated_at'])->get();

        return $this->response->collection($pages, new PagesTransformer());
    }

    public function store(PageRequest $request)
    {
        $requestPage = $request->only([
            'title',
            'slug',
            'sort',
            'status',
            'comment_status',
            'content'
        ]);
        $requestPage['html_content'] = MarkdownService::toHtml($request->input('content'));
        $page = Page::create($requestPage);

        return $this->response->item($page, new PageTransformer());
    }

    public function show($id)
    {
        $page = Page::find($id);

        if (empty($page)) {
            $this->response->errorNotFound();
        }

        return $this->response->item($page, new PageTransformer());
    }

    public function save($id, PageRequest $request)
    {
        $page = Page::find($id);

        if (empty($page)) {
            $this->response->noContent();
        }

        $requestPage = $request->only([
            'title',
            'slug',
            'sort',
            'status',
            'comment_status',
            'content'
        ]);
        $requestPage['html_content'] = MarkdownService::toHtml($request->input('content'));

        $page->update($requestPage);

        return $this->response->item($page, new PagesTransformer());
    }

    public function destroy($id)
    {
        Page::destroy($id);

        return $this->response->noContent();
    }
}
