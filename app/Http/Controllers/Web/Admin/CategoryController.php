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
        Category::create([
            'category_title' => $request->title,
        ]);

        return response('success', 201);
    }

    public function edit($id)
    {
        $category = $this->findOrFail($id, Category::class);
        return view('admin.category.edit')->with(['category_title' => $category->category_title, 'id' => $id]);
    }

    public function save($id, CategoryRequest $request)
    {
        $category = $this->findOrFail($id, Category::class);
        $category->update(['category_title' => $request->title]);
        return response('success');
    }

    public function destroy($id)
    {
        $category = $this->findOrFail($id, Category::class);
        $category->delete();

        return response('success', 204);
    }
}
