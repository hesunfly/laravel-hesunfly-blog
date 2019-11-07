<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\CheckCommentRequest;
use App\Http\Requests\TagRequest;
use App\Models\Comment;
use App\Models\Tag;
use App\Transformers\CommentsTransformer;
use App\Transformers\CommentTransformer;
use App\Transformers\TagTransformer;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('id', 'desc')->paginate(15);

        return $this->response->paginator($comments, new CommentsTransformer());
    }

    public function show($id)
    {
        $comment = $this->findOrFail($id, Comment::class);

        return $this->response->item($comment, new CommentTransformer());
    }

    public function update($id, CheckCommentRequest $request)
    {
        $comment = $this->findOrFail($id, Comment::class);
        $comment->update([
            'status' => (int) $request->status
        ]);

        return $this->response->item($comment, new CommentTransformer());
    }

    public function destroy($id)
    {
        $comment = $this->findOrFail($id, Comment::class);
        $comment->delete();

        return $this->response->noContent();
    }
}
