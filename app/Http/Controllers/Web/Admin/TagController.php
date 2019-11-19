<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\CategoryRequest;
use App\Http\Requests\Web\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tag.index')->with(['tags' => $tags]);
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(TagRequest $request)
    {
        Tag::create([
            'tag_title' => $request->title,
        ]);

        return response('success', 201);
    }

    public function edit($id)
    {
        $tag = $this->findOrFail($id, Tag::class);
        return view('admin.tag.edit')->with(['tag_title' => $tag->tag_title, 'id' => $id]);
    }

    public function save($id, TagRequest $request)
    {
        $tag = $this->findOrFail($id, Tag::class);
        $tag->update(['tag_title' => $request->title]);

        return response('success');
    }

    public function destroy($id)
    {
        $tag = $this->findOrFail($id, Tag::class);
        $tag->delete();

        return response('success', 204);
    }
}
