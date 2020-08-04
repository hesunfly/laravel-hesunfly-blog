<?php

namespace App\Http\Controllers\Api;

use App\Events\EmailSubscribeConfirm;
use App\Events\EmailSubscribeSuccess;
use App\Http\Requests\Web\SubscribeRequest;
use App\Models\Article;
use App\Models\EmailConfirmCode;
use App\Models\Subscribe;
use App\Models\Page;
use App\Services\ArticleViewCountService;
use App\Services\CacheService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index($keyword = '')
    {
        $articles = Article::with(['category' => function ($query) {
            $query->select(['id', 'category_title']);
        }])->select(['id', 'slug', 'title', 'description', 'view_count', 'publish_at', 'category_id'])
            ->where(['status' => 1])
            ->whereRaw("title like '%{$keyword}%'")
            ->orderBy('publish_at', 'desc')
            ->paginate(CacheService::getConfig('page_size'));
        $data = ['articles' => $articles, 'keyword' => $keyword];

        return $this->response->array($data);
    }

    public function article($slug, Request $request)
    {
        $article = Article::with('category')->where(['slug' => $slug])->first();

        if (empty($article)) {
            return $this->response->noContent();
        }

        //更新阅读次数
        if (ArticleViewCountService::view($article->id, $request->getClientIp())) {
            $article->increment('view_count');
        }

        return $this->response->array($article);
    }

    public function page($slug)
    {
        $page = Page::where(['slug' => $slug])->first();

        if (empty($page)) {
            return view('404');
        }

        return view('page')->with(['page' => $page]);
    }

    public function subscribe(SubscribeRequest $request)
    {
        Subscribe::create([
            'email' => $request->input('email'),
            'times' => 0,
            'status' => -1,
        ]);

        event(new EmailSubscribeConfirm($request->input('email')));

        return response('success');
    }

    public function confirm(Request $request)
    {
        $email = decrypt($request->email);
        $confirm = EmailConfirmCode::where([
            'email' => $email,
            'key' => decrypt($request->key),
            'code' => decrypt($request->code),
        ])->first();

        $msg = 'Error!';
        if (!empty($confirm)) {
            if ($confirm->status == 1) {
                $msg = '您已确认订阅，请勿重复确认！';
            } elseif ($confirm->status == -1) {
                $confirm->update(['status' => 1]);
                Subscribe::where(['email' => $email])->update(['status' => 1]);
                event(new EmailSubscribeSuccess($email));
                $msg = '确认订阅成功，您可以收到我的文章更新通知了！';
            }
        }

        return view('confirm')->with(['msg' => $msg]);
    }

}
