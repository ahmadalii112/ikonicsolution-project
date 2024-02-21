<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Service\CommentService;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CommentController extends Controller
{
    /**
     * @param  CommentService  $commentService
     */
    public function __construct(
        protected CommentService $commentService
    ) {}

    /**
     * @param  Feedback  $feedback
     * @return View
     */
    public function create(Feedback $feedback): View
    {
        return view('comments.create', [
            'comments' => $this->commentService->listComments(),
            'feedback' => $feedback
        ]);
    }

    /**
     * @param  CommentRequest  $request
     * @param  int  $feedbackId
     * @return RedirectResponse
     */
    public function store(CommentRequest $request, int $feedbackId)
    {
        $this->commentService->createComment($request->validated(), $feedbackId);
        notify()->success('Thanks for your Comment');
        return redirect()->route('comment.create', $feedbackId)->withFragment('comments');
    }

}
