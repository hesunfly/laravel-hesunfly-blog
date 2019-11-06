<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Transformers\CategoryTransformer;
use App\Http\Controllers\Api\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where(['status' => 1])->orderBy('sort', 'id')->get();

        return $this->response->collection($categories, new CategoryTransformer());
    }

    public function show($id)
    {
        $category = $this->findOrFail($id, Category::class);

        return $this->response->item($category, new CategoryTransformer());
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create([
            'category_title' => $request->title,
            'sort' => $request->sort,
            'status' => 1,
            'articles_count' => 0,
        ]);

        return $this->response->item($category, new CategoryTransformer());
    }

    public function save($id, CategoryRequest $request)
    {
        $category = $this->findOrFail($id, Category::class);
        $category->update([
            'category_title' => $request->title,
            'sort' => $request->sort,
            'status' => $request->status,
        ]);

        return $this->response->item($category, new CategoryTransformer());
    }

    public function destroy($id)
    {
        $category = $this->findOrFail($id, Category::class);
        $category->delete();
        return $this->response->noContent();
    }
}
