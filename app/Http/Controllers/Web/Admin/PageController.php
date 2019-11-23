<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Page;
use App\Services\MarkdownService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
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
        $categories = Category::where(['status' => 1])->get();
        return view('admin.article.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $requestData = $request->only([
            'title',
            'category_id',
            'description',
            'content',
        ]);
        $requestData['html_content'] = MarkdownService::toHtml($request->input('content'));
        $requestData['slug'] = empty($request->input('slug')) ? uniqid('article_') : $request->input('slug');
        DB::beginTransaction();
        $article = Article::create($requestData);

        if ($request->status == 1) {
            $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
        }
        DB::commit();

        return response('success', 201);
    }

    public function edit($id)
    {
        $categories = Category::where(['status' => 1])->get();
        $article = $this->findOrFail($id, Article::class);
        return view('admin.article.edit')->with([
            'article' => $article,
            'categories' => $categories,
            'id' => $id
        ]);
    }

    public function save($id, ArticleRequest $request)
    {
        $article = $this->findOrFail($id, Article::class);
        $requestData = $request->only([
            'title',
            'category_id',
            'description',
            'content',
        ]);
        $requestData['html_content'] = MarkdownService::toHtml($request->input('content'));
        $requestData['slug'] = empty($request->input('slug')) ? uniqid('article_') : $request->input('slug');
        DB::beginTransaction();
        $article->update($requestData);

        switch ((int) $request->status) {
            case 1:
                $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
                break;
            case -1:
                $article->update(['status' => -1]);
                break;
        }
        DB::commit();

        return response('success', 200);
    }

    public function destroy($id)
    {
        $article = $this->findOrFail($id, Article::class);
        $article->delete();

        return response('success', 204);
    }
}
