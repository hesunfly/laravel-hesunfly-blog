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

        $pages = Page::whereRaw('status = 1')->select(['slug', 'title'])->orderBy('sort')->get();
        return view('index')->with(['articles' => $articles, 'pages' => $pages]);
    }

    public function article($slug)
    {
        $article = Article::where(['slug' => $slug])->first();
        $pages = Page::whereRaw('status = 1')->select(['slug', 'title'])->orderBy('sort')->get();

        if (empty($article)) {
            return view('404')->with(['pages' => $pages]);
        }

        return view('article')->with(['article' => $article, 'pages' => $pages]);
    }

    public function page($slug)
    {
        $page = Page::where(['slug' => $slug])->first();
        $pages = Page::whereRaw('status = 1')->select(['slug', 'title'])->orderBy('sort')->get();

        if (empty($page)) {
            return view('404')->with(['pages' => $pages]);
        }
        return view('page')->with(['page' => $page, 'pages' => $pages]);
    }
}
