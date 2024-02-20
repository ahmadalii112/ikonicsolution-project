<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentController extends Controller
{
    public function __invoke(CommentRequest $request, int $feedbackId)
    {
        $comment = auth()->user()->comments()->create([
            'content' => $request->validated('content'),
            'feedback_id' => $feedbackId,
        ]);
        return new CommentResource($comment);
    }

}
