<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'feedback_id' => Feedback::factory(),
            'content' => $this->faker->text(),
        ];
    }
}
