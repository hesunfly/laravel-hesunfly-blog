<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\ArticleTag;
use App\Services\MarkdownService;
use App\Transformers\ArticlesTransformer;
use App\Transformers\ArticleTransformer;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::select(['id', 'title', 'description', 'status', 'sort', 'view_count', 'is_comment', 'updated_at', 'publish_at'])->orderByRaw('sort desc, publish_at desc')->paginate(10);

        return $this->response->paginator($articles, new ArticlesTransformer());
    }

    public function store(ArticleRequest $request)
    {
        $requestPage = $request->only([
            'title',
            'category_id',
            'description',
            'slug',
            'cover_img',
            'sort',
            'status',
            'is_comment',
            'content',
        ]);
        $requestPage['html_content'] = MarkdownService::toHtml($request->input('content'));
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

        DB::commit();

        $article->publish_at = $article->created_at;
        return $this->response->item($article, new ArticleTransformer());
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (empty($article)) {
            $this->response->errorNotFound();
        }

        return $this->response->item($article, new ArticleTransformer());
    }

    public function save($id, ArticleRequest $request)
    {
        $article = Article::find($id);

        if (empty($article)) {
            $this->response->errorNotFound();
        }

        $requestPage = $request->only([
            'title',
            'category_id',
            'description',
            'slug',
            'cover_img',
            'sort',
            'status',
            'is_comment',
            'content',
        ]);
        $requestPage['html_content'] = MarkdownService::toHtml($request->input('content'));
        DB::beginTransaction();
        $article->update($requestPage);

        $tags = $request->input('tags');
        $tag = explode(',', $tags);
        //删除已存在的tag
        ArticleTag::where(['article_id' => $id])->delete();
        $articleTag = null;
        foreach ($tag as $item) {
            ArticleTag::create([
                'tag_id' => (int)$item,
                'article_id' => $id,
            ]);
        }

        DB::commit();
        return $this->response->item($article, new ArticleTransformer());
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        Article::destroy($id);
        ArticleTag::where(['article_id' => $id])->delete();
        DB::commit();
        return $this->response->noContent();
    }
}
