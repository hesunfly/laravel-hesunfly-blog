<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::with(['tags', 'category', 'commentNumber' => function($query) {
            $query->select('id', 'article_id');
        }])->where(['status' => 1])->orderBy('publish_at', 'desc')->paginate(10);

        return view('index')->with(['articles' => $articles]);
    }
}
