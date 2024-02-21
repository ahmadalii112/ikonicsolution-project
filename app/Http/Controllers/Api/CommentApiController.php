<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Service\CommentService;
use App\Models\Comment;

class CommentApiController extends Controller
{
    /**
     * @param  CommentService  $commentService
     */
    public function __construct(
        protected CommentService $commentService
    ) {}

    /**
     * @param  CommentRequest  $request
     * @param  int  $feedbackId
     * @return CommentResource
     */
    public function __invoke(CommentRequest $request, int $feedbackId)
    {
        $comment = $this->commentService->createComment($request->validated(), $feedbackId);
        return new CommentResource($comment);
    }

}
