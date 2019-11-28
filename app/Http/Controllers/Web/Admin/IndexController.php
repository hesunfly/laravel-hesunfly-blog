<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Article;
use App\Models\Ip;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $article_count = Article::where(['status' => 1])->count();
        $this->statistics();
        return view('admin.index')->with(['article_count' => $article_count]);
    }

    public function ips()
    {
        $ips = Ip::orderByRaw('id desc')->paginate(20);

        return view('admin.ip')->with(['ips' => $ips]);
    }

    private function statistics()
    {
        $res = DB::select("select count(id) count,MONTH (publish_at) publish_at FROM articles GROUP BY MONTH (publish_at) ORDER BY MONTH (publish_at) DESC");

    }
}
