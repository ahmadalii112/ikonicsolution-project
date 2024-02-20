<?php

namespace App\Http\Resources;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Feedback */
class FeedbackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'user' => $this->whenLoaded('user', fn() => new UserResource($this->user)),
            'comments' => $this->whenLoaded('user', fn() => CommentResource::collection($this->comments)),
        ];
    }
}
