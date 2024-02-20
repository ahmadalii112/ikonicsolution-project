<?php

namespace Database\Factories;

use App\Models\Feedback;
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
            'user_id' => $this->faker->word(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(),
            'category' => $this->faker->word(),
        ];
    }
}
