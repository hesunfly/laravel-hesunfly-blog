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
        $count = $this->statistics();
        dd($count);
        return view('admin.index')->with(['article_count' => $article_count, 'count' => $count]);
    }

    public function ips()
    {
        $ips = Ip::orderByRaw('id desc')->paginate(20);

        return view('admin.ip')->with(['ips' => $ips]);
    }

    //文章数按月统计
    private function statistics()
    {
        $res = DB::select("select count(id) count,MONTH (publish_at) publish_at FROM articles GROUP BY MONTH (publish_at) ORDER BY MONTH (publish_at) DESC");
        $temp = [];
        foreach ($res as $item) {
            if (!empty($item->publish_at)) {
                $temp[$item->publish_at] = $item->count;
            }
        }
        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = isset($temp[$i]) ? $temp[$i] : 0;
        }
        return json_encode(array_values($data));
    }
}
