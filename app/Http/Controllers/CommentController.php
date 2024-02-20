<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Feedback;

class CommentController extends Controller
{
    public function create(Feedback $feedback)
    {
        $comments = Comment::with('user')->get();
        return view('comments.create', compact('feedback', 'comments'));
    }

    public function store(CommentRequest $request, int $feedbackId)
    {
        $comment = auth()->user()->comments()->create([
            'content' => $request->validated('content'),
            'feedback_id' => $feedbackId,
        ]);
        return redirect()->route('comment.create', $feedbackId)->withFragment('comments');
    }

}
