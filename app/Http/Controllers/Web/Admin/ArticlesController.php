<?php

namespace App\Http\Controllers\Web\Admin;

use App\Events\ArticleUpdate;
use App\Http\Requests\Web\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Services\CacheService;
use App\Services\QrCodeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function index($category = '', $keyword = '')
    {
        $where = ' 1 = 1 ';
        $category_id = ' ';
        if (!empty($category) && $category !== '所有类别') {
            $category_res = Category::select(['id'])->where(['category_title' => $category])->first();
            $category_id = $category_res->id;
            if (!empty($category_id)) {
                $where .= ' and category_id = ' . $category_id;
            }
        }

        if (!empty($keyword)) {
            $where .= ' and title like ' . "'" . '%' . $keyword . '%' . "'";
        }

        $articles = Article::whereRaw($where)->with('category')->orderByRaw('created_at desc')->paginate(CacheService::getConfig('admin_page_size'));
        $categories = Category::orderByRaw('articles_count desc')->get();
        return view('admin.article.index')->with([
            'articles' => $articles,
            'categories' => $categories,
            'category_id' => $category_id,
            'keyword' => $keyword,
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.article.create')->with([
            'categories' => $categories
        ]);
    }

    public function store(ArticleRequest $request)
    {
        $requestData = $request->only([
            'title',
            'category_id',
            'description',
            'content',
            'html_content',
        ]);
        $slug = $request->input('slug');
        $requestData['slug'] = empty($slug) ? uniqid('article_') : $slug;
        DB::beginTransaction();
        $article = Article::create($requestData);

        if ($request->status == 1) {
            //生成二维码
            $qrPath = QrCodeService::generate($article->slug);

            $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString(), 'qr_path' => $qrPath]);

            //发送订阅
            event(new ArticleUpdate($article));
        }

        Category::find($request->input('category_id'))->increment('articles_count');

        DB::commit();

        return response('success', 201);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $article = $this->findOrFail($id, Article::class);
        return view('admin.article.edit')->with([
            'article' => $article,
            'categories' => $categories,
            'id' => $id
        ]);
    }

    public function save($id, ArticleRequest $request)
    {
        $article = $this->findOrFail($id, Article::class);
        $old_article_category = $article->category_id;
        $requestData = $request->only([
            'title',
            'category_id',
            'description',
            'content',
            'html_content',
        ]);
        $requestData['slug'] = empty($request->input('slug')) ? uniqid('article_') : $request->input('slug');
        DB::beginTransaction();
        $article->update($requestData);

        switch ((int)$request->status) {
            case 1:
                if ($article->status == -1) {
                    $article->update(['status' => 1, 'publish_at' => Carbon::now()->toDateTimeString()]);
                }
                //重新生成二维码
                $qrPath = QrCodeService::generate($article->slug);
                $article->update(['qr_path' => $qrPath]);
                //发送订阅
                event(new ArticleUpdate($article));
                break;
            case -1:
                $article->update(['status' => -1]);
                break;
        }
        $category_id = $request->input('category_id');
        if ($old_article_category != $category_id) {
            Category::find($category_id)->increment('articles_count');
            Category::find($old_article_category)->decrement('articles_count');
        }

        DB::commit();

        return response('success', 200);
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);
        } catch (\Exception $exception) {
            return response('error', 404);
        }

        DB::beginTransaction();
        DB::table('articles')->where(['id' => $id])->delete();
        Category::find($article->category_id)->decrement('articles_count');
        DB::commit();

        return response('success', 204);
    }

}
