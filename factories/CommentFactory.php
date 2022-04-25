<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => $this->faker->title(),
            'user_id' => $this->faker->user_id(),
            'post_id' => $this->faker->post_id(),
            'remember_token' => Str::random(10),

        ];
    }

}
