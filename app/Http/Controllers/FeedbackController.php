<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with(['user', 'comments'])->paginate(3);
        return view('feedback.index', compact('feedbacks'));
    }
    public function create()
    {
        return view('feedback.create');
    }

    public function store(FeedbackRequest $request)
    {
        $feedback =  auth()->user()->feedbacks()->create($request->validated());
        return redirect(route('feedback.index'));
    }

}
