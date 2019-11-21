<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $article_count = Article::where(['status' => 1])->count();
        return view('admin.index')->with(['article_count' => $article_count]);
    }
}
