<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Ip;
use App\Models\Image;
use App\Models\Page;
use App\Models\Tag;
use App\Models\User;

class AppController extends Controller
{
    public function dashboard()
    {
        $data = [
            'member' => User::count(),
            'tag' => Tag::count(),
            'category' => Category::count(),
            'article' => Article::count(),
            'page' => Page::count(),
            'comment' => Comment::count(),
            'images' => Image::count(),
            'file' => Ip::count(),
        ];

        return $this->response->array(['data' => $data]);
    }
}
