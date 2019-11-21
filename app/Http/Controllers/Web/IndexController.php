<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')->where(['status' => 1])->orderBy('publish_at', 'desc')->paginate(10);
        return view('index')->with(['articles' => $articles]);
    }
}
