<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;

class FeedbackApiController extends Controller
{
    public function index()
    {
        return FeedbackResource::collection(Feedback::with(['user', 'comments'])->paginate(10));
    }

    public function store(FeedbackRequest $request)
    {
        $feedback =  auth()->user()->feedbacks()->create($request->validated());
        return new FeedbackResource($feedback);
    }

}
