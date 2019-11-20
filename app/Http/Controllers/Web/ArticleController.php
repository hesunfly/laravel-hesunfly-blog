<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index($slug)
    {
        $article = Article::where(['slug' => $slug])->first();

        return view('article')->with(['article' => $article]);
    }
}
