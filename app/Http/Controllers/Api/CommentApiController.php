<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

class CommentApiController extends Controller
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
