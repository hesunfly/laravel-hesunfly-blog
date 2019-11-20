<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\MarkdownService;
use Carbon\Carbon;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderByRaw('id desc')->paginate(10);
        return view('admin.article.index')->with([
            'articles' => $articles,
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
            'slug',
            'content',
        ]);
        $requestData['html_content'] = MarkdownService::toHtml($request->input('content'));

        $article = Article::create($requestData);

        if ($request->status == 1) {
            $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
        }

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
}
