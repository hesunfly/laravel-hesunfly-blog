<?php

namespace App\Http\Controllers\Web;

use App\Models\Article;
use App\Models\Page;
use App\Services\ArticleViewCountService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    public function index()
    {
        $articles = Article::with('category')
            ->where(['status' => 1])
            ->orderBy('publish_at', 'desc')
            ->paginate(config('blog.page_size'));
        return view('index')->with(['articles' => $articles]);
    }

    public function article($slug, Request $request)
    {
        $article = Article::with('category')->where(['slug' => $slug])->first();

        if (empty($article)) {
            return view('404');
        }

        //更新阅读次数
        if (ArticleViewCountService::view($article->id, $request->getClientIp())) {
            $article->increment('view_count');
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
