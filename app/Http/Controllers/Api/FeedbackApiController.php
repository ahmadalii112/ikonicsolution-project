<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Http\Service\FeedbackService;
use App\Models\Feedback;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FeedbackApiController extends Controller
{
    /**
     * @param  FeedbackService  $feedbackService
     */
    public function __construct(
        protected FeedbackService $feedbackService
    ) {
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return FeedbackResource::collection($this->feedbackService->listFeedback());
    }

    /**
     * @param  FeedbackRequest  $request
     * @return FeedbackResource
     */
    public function store(FeedbackRequest $request)
    {
        return new FeedbackResource($this->feedbackService->createFeedback($request->validated()));
    }
}
