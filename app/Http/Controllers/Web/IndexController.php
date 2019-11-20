<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::where(['status' => 1])->orderBy('publish_at', 'desc')->paginate(2);
        return view('index')->with(['articles' => $articles]);
    }
}
