<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Http\Service\FeedbackService;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * @param  FeedbackService  $feedbackService
     */
    public function __construct(
        protected FeedbackService $feedbackService
    )
    {}

    /**
     * @return View
     */
    public function index(): View
    {
        $feedbacks = $this->feedbackService->listFeedback();
        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('feedback.create');
    }

    /**
     * @param  FeedbackRequest  $request
     * @return RedirectResponse
     */
    public function store(FeedbackRequest $request): RedirectResponse
    {
        $this->feedbackService->createFeedback($request->validated());
        return redirect(route('feedback.index'));
    }

}
