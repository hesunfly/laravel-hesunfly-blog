<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Services\MarkdownService;
use App\Transformers\ArticlesTransformer;
use App\Transformers\ArticleTransformer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::select([
            'id', 'title', 'description', 'status', 'sort', 'view_count',
            'comment_status', 'updated_at', 'publish_at',
        ])->orderByRaw('sort desc, publish_at desc')->paginate(10);

        return $this->response->paginator($articles, new ArticlesTransformer());
    }

    public function store(ArticleRequest $request)
    {
        $requestPage = $request->only([
            'title',
            'category_id',
            'description',
            'slug',
            'sort',
            'comment_status',
            'content',
        ]);
        DB::beginTransaction();
        $article = Article::create($requestPage);

        $tags = $request->input('tags');
        $tag = explode(',', $tags);
        $articleTag = null;
        foreach ($tag as $item) {
            ArticleTag::create([
                'tag_id' => (int)$item,
                'article_id' => $article->id,
            ]);
        }

        if ($request->status == 1) {
            $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
        }

        DB::commit();
        return $this->response->item($article, new ArticleTransformer());
    }

    public function show($id)
    {
        $article = $this->findOrFail($id, Article::class);
        return $this->response->item($article, new ArticleTransformer());
    }

    public function save($id, ArticleRequest $request)
    {
        $article = $this->findOrFail($id, Article::class);
        $requestPage = $request->only([
            'title',
            'category_id',
            'description',
            'slug',
            'cover_img',
            'sort',
            'comment_status',
            'content',
        ]);
        $requestPage['html_content'] = MarkdownService::toHtml($request->input('content'));
        DB::beginTransaction();
        $article->update($requestPage);

        $tags = $request->input('tags');
        $tag = explode(',', $tags);
        //删除已存在的tag
        ArticleTag::where(['article_id' => $id])->forceDelete();
        $articleTag = null;
        foreach ($tag as $item) {
            ArticleTag::create([
                'tag_id' => (int)$item,
                'article_id' => $id,
            ]);
        }
        switch ((int) $request->status) {
            case 1:
                $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
                break;
            case -1:
                $article->update(['status' => -1]);
                break;
        }
        DB::commit();
        return $this->response->item($article, new ArticleTransformer());
    }

    public function updatePublishStatus($id, ArticleRequest $request)
    {
        $article = $this->findOrFail($id, Article::class);

        switch ((int) $request->status) {
            case 1:
                $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
                break;
            case -1:
                $article->update(['status' => -1]);
                break;
        }

        return $this->response->item($article, new ArticleTransformer());
    }

    public function destroy($id)
    {
        $article = $this->findOrFail($id, Article::class);
        DB::beginTransaction();
        $article->delete();
        ArticleTag::where(['article_id' => $id])->delete();
        DB::commit();
        return $this->response->noContent();
    }
}
