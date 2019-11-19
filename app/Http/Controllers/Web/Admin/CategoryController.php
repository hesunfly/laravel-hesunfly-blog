<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index')->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'category_title' => $request->title,
        ]);

        return response('success', 201);
    }
}
