<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Page;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where(['status' => 1])
            ->orderBy('publish_at', 'desc')
            ->paginate(10);
        return view('index')->with(['articles' => $articles]);
    }

    public function article($slug)
    {
        $article = Article::where(['slug' => $slug])->first();

        if (empty($article)) {
            return view('404');
        }

        return view('article')->with(['article' => $article]);
    }

    public function page($slug)
    {
        $page = Page::where(['slug' => $slug])->first();

        if (empty($page)) {
            return view('404');
        }

        return view('page')->with(['page' => $page]);
    }
}
