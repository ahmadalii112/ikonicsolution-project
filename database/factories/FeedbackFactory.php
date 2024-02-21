<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'category' => $this->faker->randomElement(['Bug Report', 'feature request', 'improvement']),
        ];
    }
}
