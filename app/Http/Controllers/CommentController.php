<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @param  Feedback  $feedback
     * @return View
     */
    public function create(Feedback $feedback): View
    {
        $comments = Comment::with('user')->get();
        return view('comments.create', compact('feedback', 'comments'));
    }

    /**
     * @param  CommentRequest  $request
     * @param  int  $feedbackId
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, int $feedbackId)
    {
        $comment = auth()->user()->comments()->create([
            'content' => $request->validated('content'),
            'feedback_id' => $feedbackId,
        ]);
        return redirect()->route('comment.create', $feedbackId)->withFragment('comments');
    }

}
