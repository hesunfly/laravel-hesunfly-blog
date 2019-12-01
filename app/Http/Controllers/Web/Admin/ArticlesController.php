<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\MarkdownService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->orderByRaw('created_at desc')->paginate(config('blog.admin_page_size'));
        return view('admin.article.index')->with([
            'articles' => $articles,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
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
            'html_content',
        ]);
        $requestData['slug'] = empty($request->input('slug')) ? uniqid('article_') : $request->input('slug');
        DB::beginTransaction();
        $article = Article::create($requestData);

        if ($request->status == 1) {
            $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
        }

        Category::find($request->input('category_id'))->increment('articles_count');
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
            'html_content',
        ]);
        $requestData['slug'] = empty($request->input('slug')) ? uniqid('article_') : $request->input('slug');
        DB::beginTransaction();
        $article->update($requestData);

        switch ((int) $request->status) {
            case 1:
                if ($article->status == -1) {
                    $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
                }
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
        DB::beginTransaction();
        $article->delete();
        Category::find($article->category_id)->decrement('articles_count');
        DB::commit();

        return response('success', 204);
    }
}