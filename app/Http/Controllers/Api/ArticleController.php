<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use App\Transformers\ArticlesTransformer;
use App\Transformers\ArticleTransformer;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {   
        $articles = Article::with(['tags', 'category', 'commentNumber' => function($query) {
            $query->select('id', 'article_id');
        }])->where(['status' => 1])->orderBy('publish_at', 'desc')->paginate(10);
        return $this->response->paginator($articles, new ArticlesTransformer());
    }

    public function show($slug)
    {
        $article = Article::with(['tags', 'category'])->where('slug', $slug)->first();
        if (empty($article)) {
            $this->response->errorNotFound();
        }

        return $this->response->item($article, new ArticleTransformer());
    }

}
