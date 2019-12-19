<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Web\FellowRequest;
use App\Models\Article;
use App\Models\Fellow;
use App\Models\Page;
use App\Services\ArticleViewCountService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index($keyword = '')
    {
        $articles = Article::with('category')
            ->where(['status' => 1])
            ->whereRaw("title like '%{$keyword}%'")
            ->orderBy('publish_at', 'desc')
            ->paginate(config('blog.page_size'));
        return view('index')->with(['articles' => $articles, 'keyword' => $keyword]);
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

    public function fellow(FellowRequest $request)
    {
        Fellow::create([
            'email' => $request->input('email'),
            'times' => 0
        ]);

        return response('success');
    }
}
