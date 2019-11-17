<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index($slug)
    {
        $article = Article::with(['tags', 'category', 'commentNumber' => function($query) {
            $query->select('id', 'article_id');
        }])->where(['slug' => $slug])->first();

        return view('article')->with(['article' => $article, 'tags' => $article->tags, 'category' => $article->category]);
    }
}
