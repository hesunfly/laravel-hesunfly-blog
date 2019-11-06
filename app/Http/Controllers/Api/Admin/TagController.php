<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use App\Transformers\TagTransformer;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where(['status' => 1])->orderBy('sort', 'id')->get();

        return $this->response->collection($tags, new TagTransformer());
    }

    public function show($id)
    {
        $tag = $this->findOrFail($id, Tag::class);

        return $this->response->item($tag, new TagTransformer());
    }

    public function store(TagRequest $request)
    {
        $tag = Tag::create([
            'tag_title' => $request->title,
            'sort' => $request->sort,
            'status' => 1,
            'articles_count' => 0,
        ]);

        return $this->response->item($tag, new TagTransformer());
    }

    public function save($id, TagRequest $request)
    {
        $tag = $this->findOrFail($id, Tag::class);
        $tag->update([
            'tag_title' => $request->title,
            'sort' => $request->sort,
            'status' => $request->status,
        ]);

        return $this->response->item($tag, new TagTransformer());
    }

    public function destroy($id)
    {
        $tag = $this->findOrFail($id, Tag::class);
        $tag->delete();

        return $this->response->noContent();
    }
}
