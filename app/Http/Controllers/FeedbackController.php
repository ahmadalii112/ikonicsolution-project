<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $feedbacks = Feedback::with(['user', 'comments'])->paginate(3);
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
        $feedback = auth()->user()->feedbacks()->create($request->validated());
        return redirect(route('feedback.index'));
    }

}
