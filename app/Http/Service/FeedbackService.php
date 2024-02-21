<?php

namespace App\Http\Service;

use App\Models\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackService
{
    /**
     * @return LengthAwarePaginator
     */
    public function listFeedback(): LengthAwarePaginator
    {
        return Feedback::with(['user', 'comments'])->paginate(5);
    }

    /**
     * @param  array  $data
     * @return Feedback|Model
     */
    public function createFeedback(array $data): Feedback|Model
    {
        return auth()->user()->feedbacks()->create($data);
    }
}
